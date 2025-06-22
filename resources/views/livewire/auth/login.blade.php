<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\User;
use App\Services\SmsService;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('required|string|size:6')]
    public string $otp = '';

    #[Validate('required|string')]
    public string $phoneNumber = '';

    #[Validate('required|string|size:6')]
    public string $smsOtp = '';

    public bool $remember = false;
    public string $activeTab = 'password'; // 'password', 'otp', or 'sms'
    public bool $otpSent = false;
    public bool $smsOtpSent = false;
    public bool $isLoading = false;
    public int $resendCountdown = 0;
    public int $smsResendCountdown = 0;
    public bool $canResend = true;
    public bool $canSmsResend = true;
    public string $selectedCountryCode = '+1';
    public bool $showCountryDropdown = false;
    public string $countrySearch = '';

    /**
     * Handle an incoming authentication request with password.
     */
    public function loginWithPassword(): void
    {
        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Send OTP to user's email
     */
    public function sendOtp(): void
    {
        $this->validate([
            'email' => 'required|string|email',
        ]);

        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Check if user has a recent OTP that hasn't expired
        if ($user->otp_code && !$user->isOtpExpired()) {
            $remainingTime = now()->diffInSeconds($user->otp_expires_at);
            if ($remainingTime > 0) {
                $this->resendCountdown = $remainingTime;
                $this->canResend = false;
                $this->otpSent = true;
                session()->flash('status', 'OTP already sent. Please wait before requesting a new one.');
                return;
            }
        }

        $user->generateOtp();
        $this->otpSent = true;
        $this->isLoading = false;
        $this->resendCountdown = 60; // 60 seconds cooldown
        $this->canResend = false;

        session()->flash('status', 'OTP has been sent to your email address.');
    }

    /**
     * Handle an incoming authentication request with OTP.
     */
    public function loginWithOtp(): void
    {
        $this->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string|size:6',
        ]);

        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if (!$user->verifyOtp($this->otp)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP code.',
            ]);
        }

        Auth::login($user, $this->remember);
        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Send SMS OTP to user's phone
     */
    public function sendSmsOtp(): void
    {
        $this->validate([
            'phoneNumber' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited();

        $smsService = app(SmsService::class);
        $fullPhoneNumber = $this->getFullPhoneNumber();
        
        if (!$smsService->validatePhoneNumber($fullPhoneNumber)) {
            throw ValidationException::withMessages([
                'phoneNumber' => 'Please enter a valid phone number.',
            ]);
        }

        $formattedPhone = $smsService->formatPhoneNumber($fullPhoneNumber);
        $user = User::where('phone_number', $formattedPhone)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phoneNumber' => 'No account found with this phone number.',
            ]);
        }

        // Check if user has a recent SMS OTP that hasn't expired
        if ($user->sms_otp_code && !$user->isSmsOtpExpired()) {
            $remainingTime = now()->diffInSeconds($user->sms_otp_expires_at);
            if ($remainingTime > 0) {
                $this->smsResendCountdown = $remainingTime;
                $this->canSmsResend = false;
                $this->smsOtpSent = true;
                session()->flash('status', 'SMS OTP already sent. Please wait before requesting a new one.');
                return;
            }
        }

        $user->generateSmsOtp();
        $this->smsOtpSent = true;
        $this->isLoading = false;
        $this->smsResendCountdown = 60; // 60 seconds cooldown
        $this->canSmsResend = false;

        session()->flash('status', 'SMS OTP has been sent to your phone number.');
    }

    /**
     * Handle an incoming authentication request with SMS OTP.
     */
    public function loginWithSmsOtp(): void
    {
        $this->validate([
            'phoneNumber' => 'required|string',
            'smsOtp' => 'required|string|size:6',
        ]);

        $this->ensureIsNotRateLimited();

        $smsService = app(SmsService::class);
        $fullPhoneNumber = $this->getFullPhoneNumber();
        $formattedPhone = $smsService->formatPhoneNumber($fullPhoneNumber);
        $user = User::where('phone_number', $formattedPhone)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phoneNumber' => 'No account found with this phone number.',
            ]);
        }

        if (!$user->verifySmsOtp($this->smsOtp)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'smsOtp' => 'Invalid or expired SMS OTP code.',
            ]);
        }

        Auth::login($user, $this->remember);
        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Switch between authentication tabs
     */
    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->otpSent = false;
        $this->smsOtpSent = false;
        $this->otp = '';
        $this->smsOtp = '';
        $this->resendCountdown = 0;
        $this->smsResendCountdown = 0;
        $this->canResend = true;
        $this->canSmsResend = true;
        $this->showCountryDropdown = false;
        $this->countrySearch = '';
        $this->resetErrorBag();
    }

    /**
     * Toggle country code dropdown
     */
    public function toggleCountryDropdown(): void
    {
        $this->showCountryDropdown = !$this->showCountryDropdown;
    }

    /**
     * Select country code
     */
    public function selectCountryCode(string $code): void
    {
        $this->selectedCountryCode = $code;
        $this->showCountryDropdown = false;
        $this->countrySearch = '';
    }

    /**
     * Get formatted phone number with country code
     */
    public function getFullPhoneNumber(): string
    {
        return $this->selectedCountryCode . $this->phoneNumber;
    }

    /**
     * Get country codes for dropdown
     */
    public function getCountryCodes(): \Illuminate\Support\Collection
    {
        $countries = config('countries.codes', []);
        $popular = config('countries.popular', []);
        
        // Sort popular countries first
        $popularCountries = collect($countries)->whereIn('code', $popular);
        $otherCountries = collect($countries)->whereNotIn('code', $popular);
        
        return $popularCountries->merge($otherCountries);
    }

    /**
     * Get selected country info
     */
    public function getSelectedCountry(): array
    {
        $country = $this->getCountryCodes()->firstWhere('code', $this->selectedCountryCode);
        return $country ?: ['code' => '+1', 'name' => 'United States', 'flag' => '🇺🇸', 'format' => '(555) 123-4567'];
    }

    /**
     * Close dropdown when clicking outside
     */
    public function closeDropdown(): void
    {
        $this->showCountryDropdown = false;
        $this->countrySearch = '';
    }

    /**
     * Filter countries based on search
     */
    public function getFilteredCountries(): array
    {
        $countries = $this->getCountryCodes();
        if (empty($this->countrySearch)) {
            return $countries->values()->all();
        }
        return $countries->filter(function ($country) {
            $search = strtolower($this->countrySearch);
            return str_contains(strtolower($country['name']), $search) ||
                   str_contains(strtolower($country['code']), $search);
        })->values()->all();
    }

    /**
     * Update countdown timer
     */
    public function updateCountdown(): void
    {
        if ($this->resendCountdown > 0) {
            $this->resendCountdown--;
            if ($this->resendCountdown === 0) {
                $this->canResend = true;
            }
        }

        if ($this->smsResendCountdown > 0) {
            $this->smsResendCountdown--;
            if ($this->smsResendCountdown === 0) {
                $this->canSmsResend = true;
            }
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        $identifier = $this->activeTab === 'sms' ? $this->phoneNumber : $this->email;
        return Str::transliterate(Str::lower($identifier).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6" wire:poll.10s="updateCountdown">
    <x-auth-header :title="__('Log in to your account')" :description="__('Use your preferred login method or try alternatives below')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Tab Navigation - Hidden -->
    {{-- <div class="flex rounded-lg bg-zinc-100 dark:bg-zinc-800 p-1">
        <button 
            wire:click="switchTab('password')" 
            class="flex-1 px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeTab === 'password' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-zinc-100 shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100' }}"
        >
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            Password
        </button>
        <button 
            wire:click="switchTab('otp')" 
            class="flex-1 px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeTab === 'otp' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-zinc-100 shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100' }}"
        >
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Email OTP
        </button>
        <button 
            wire:click="switchTab('sms')" 
            class="flex-1 px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeTab === 'sms' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-zinc-100 shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100' }}"
        >
            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            SMS OTP
        </button>
    </div> --}}

    <!-- Password Authentication Tab -->
    @if($activeTab === 'password')
        <form wire:submit="loginWithPassword" class="flex flex-col gap-6">
            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox wire:model="remember" :label="__('Remember me')" />

            <!-- Try Others Option -->
            <div class="border-t border-zinc-200 dark:border-zinc-600 pt-4">
                <div class="text-center">
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">Want to try a different login method?</p>
                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                        <button 
                            type="button" 
                            wire:click="switchTab('otp')" 
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Try Email OTP
                        </button>
                        <button 
                            type="button" 
                            wire:click="switchTab('sms')" 
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Try SMS OTP
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" :disabled="$isLoading">
                    @if($isLoading)
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    @endif
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>
    @endif

    <!-- Email OTP Authentication Tab -->
    @if($activeTab === 'otp')
        <form wire:submit="{{ $otpSent ? 'loginWithOtp' : 'sendOtp' }}" class="flex flex-col gap-6">
            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                :disabled="$otpSent"
            />

            @if(!$otpSent)
                <!-- Email OTP Information -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div class="text-sm">
                            <p class="font-medium text-blue-800 dark:text-blue-200 mb-1">Email OTP Authentication</p>
                            <p class="text-blue-700 dark:text-blue-300">
                                We'll send a 6-digit security code to your email address. 
                                The code expires in 5 minutes for your security.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($otpSent)
                <!-- OTP Code -->
                <div class="space-y-3">
                    <flux:input
                        wire:model="otp"
                        :label="__('OTP Code')"
                        type="text"
                        required
                        maxlength="6"
                        placeholder="000000"
                        class="text-center text-2xl tracking-widest font-mono"
                        autofocus
                        wire:keydown.enter="loginWithOtp"
                    />
                    
                    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 bg-green-50 dark:bg-green-900/20 rounded-lg p-3">
                        <div class="flex items-center justify-center mb-1">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium text-green-800 dark:text-green-200">OTP Sent Successfully!</span>
                        </div>
                        <p>We've sent a 6-digit code to <strong class="text-zinc-900 dark:text-zinc-100">{{ $email }}</strong></p>
                        <p class="text-xs mt-1">The code will expire in <strong class="text-red-600 dark:text-red-400">5 minutes</strong></p>
                    </div>
                </div>

                <!-- Improved Resend OTP Button -->
                <div class="text-center">
                    @if($canResend)
                        <button 
                            type="button" 
                            wire:click="sendOtp" 
                            class="text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium"
                            :disabled="$isLoading"
                        >
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Resend OTP
                        </button>
                    @else
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Resend available in <span class="font-mono font-bold text-blue-600 dark:text-blue-400">{{ $resendCountdown }}</span> seconds
                        </div>
                    @endif
                </div>

                <!-- Try Others Option -->
                <div class="border-t border-zinc-200 dark:border-zinc-600 pt-4">
                    <div class="text-center">
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">Having trouble with email OTP?</p>
                        
                        <!-- Helpful Tips -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-4 text-left">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-medium text-blue-800 dark:text-blue-200 mb-1">Email OTP Tips:</p>
                                    <ul class="text-blue-700 dark:text-blue-300 space-y-1 text-xs">
                                        <li>• Check your spam/junk folder</li>
                                        <li>• Ensure email address is correct</li>
                                        <li>• Wait a few minutes for delivery</li>
                                        <li>• Try resending if needed</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-3">Or try these alternative login methods:</p>
                        
                        <div class="flex flex-col sm:flex-row gap-2 justify-center">
                            <button 
                                type="button" 
                                wire:click="switchTab('password')" 
                                class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors shadow-sm"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Try Password Login
                            </button>
                            <button 
                                type="button" 
                                wire:click="switchTab('sms')" 
                                class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors shadow-sm"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Try SMS OTP
                            </button>
                        </div>
                        
                        <!-- Contact Support -->
                        <div class="mt-4 pt-3 border-t border-zinc-200 dark:border-zinc-600">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Still having issues? 
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Contact Support</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Remember Me (only show when OTP is sent) -->
            @if($otpSent)
                <flux:checkbox wire:model="remember" :label="__('Remember me')" />
            @endif

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" :disabled="$isLoading">
                    @if($isLoading)
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    @endif
                    {{ $otpSent ? __('Verify & Log in') : __('Send OTP') }}
                </flux:button>
            </div>
        </form>
    @endif

    <!-- SMS OTP Authentication Tab -->
    @if($activeTab === 'sms')
        <form wire:submit="{{ $smsOtpSent ? 'loginWithSmsOtp' : 'sendSmsOtp' }}" class="flex flex-col gap-6" wire:click.self="closeDropdown">
            <!-- Phone Number with Country Code -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('Phone Number') }}
                </label>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Country Code Selector -->
                    <div class="relative flex-shrink-0">
                        <button 
                            type="button"
                            wire:click="toggleCountryDropdown"
                            class="w-full sm:w-auto min-w-[120px] flex items-center justify-between px-4 py-3 text-sm border border-zinc-300 dark:border-zinc-600 rounded-lg sm:rounded-r-none bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 hover:bg-zinc-50 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors touch-manipulation"
                        >
                            <div class="flex items-center">
                                <span class="mr-2 text-lg">{{ $this->getSelectedCountry()['flag'] }}</span>
                                <span class="font-mono text-sm sm:text-base">{{ $this->getSelectedCountry()['code'] }}</span>
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform {{ $showCountryDropdown ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Country Code Dropdown -->
                        @if($showCountryDropdown)
                            <div class="absolute z-50 w-full sm:w-80 mt-1 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg shadow-xl max-h-72 overflow-y-auto sm:left-0 left-0 sm:right-auto right-0">
                                <!-- Search Input -->
                                <div class="p-3 border-b border-zinc-200 dark:border-zinc-600 sticky top-0 bg-white dark:bg-zinc-800 z-10">
                                    <div class="relative">
                                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <input 
                                            type="text" 
                                            wire:model.live="countrySearch"
                                            placeholder="Search countries..."
                                            class="w-full pl-10 pr-3 py-3 text-sm border border-zinc-300 dark:border-zinc-600 rounded-md bg-white dark:bg-zinc-700 text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        >
                                    </div>
                                </div>

                                <div class="p-2">
                                    @if(count($this->getFilteredCountries()) > 0)
                                        @if(empty($countrySearch))
                                            <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2 px-2">Popular Countries</div>
                                            @foreach(array_slice($this->getFilteredCountries(), 0, 10) as $country)
                                                <button 
                                                    type="button"
                                                    wire:click="selectCountryCode('{{ $country['code'] }}')"
                                                    class="w-full flex items-center px-3 py-3 text-sm hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors {{ $selectedCountryCode === $country['code'] ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-zinc-700 dark:text-zinc-300' }} touch-manipulation"
                                                >
                                                    <span class="mr-3 text-lg">{{ $country['flag'] }}</span>
                                                    <span class="flex-1 text-left truncate font-medium">{{ $country['name'] }}</span>
                                                    <span class="font-mono text-zinc-500 dark:text-zinc-400 ml-2 text-sm">{{ $country['code'] }}</span>
                                                </button>
                                            @endforeach
                                            
                                            @if(count($this->getFilteredCountries()) > 10)
                                                <div class="border-t border-zinc-200 dark:border-zinc-600 my-3"></div>
                                                
                                                <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2 px-2">All Countries</div>
                                                @foreach(array_slice($this->getFilteredCountries(), 10) as $country)
                                                    <button 
                                                        type="button"
                                                        wire:click="selectCountryCode('{{ $country['code'] }}')"
                                                        class="w-full flex items-center px-3 py-3 text-sm hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors {{ $selectedCountryCode === $country['code'] ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-zinc-700 dark:text-zinc-300' }} touch-manipulation"
                                                    >
                                                        <span class="mr-3 text-lg">{{ $country['flag'] }}</span>
                                                        <span class="flex-1 text-left truncate font-medium">{{ $country['name'] }}</span>
                                                        <span class="font-mono text-zinc-500 dark:text-zinc-400 ml-2 text-sm">{{ $country['code'] }}</span>
                                                    </button>
                                                @endforeach
                                            @endif
                                        @else
                                            <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2 px-2">Search Results</div>
                                            @foreach($this->getFilteredCountries() as $country)
                                                <button 
                                                    type="button"
                                                    wire:click="selectCountryCode('{{ $country['code'] }}')"
                                                    class="w-full flex items-center px-3 py-3 text-sm hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors {{ $selectedCountryCode === $country['code'] ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-zinc-700 dark:text-zinc-300' }} touch-manipulation"
                                                >
                                                    <span class="mr-3 text-lg">{{ $country['flag'] }}</span>
                                                    <span class="flex-1 text-left truncate font-medium">{{ $country['name'] }}</span>
                                                    <span class="font-mono text-zinc-500 dark:text-zinc-400 ml-2 text-sm">{{ $country['code'] }}</span>
                                                </button>
                                            @endforeach
                                        @endif
                                    @else
                                        <div class="text-center py-6 text-zinc-500 dark:text-zinc-400">
                                            <svg class="w-12 h-12 mx-auto mb-3 text-zinc-300 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <p class="text-sm font-medium">No countries found</p>
                                            <p class="text-xs mt-1">Try a different search term</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Phone Number Input -->
                    <flux:input
                        wire:model="phoneNumber"
                        type="tel"
                        required
                        autofocus
                        autocomplete="tel"
                        placeholder="{{ $this->getSelectedCountry()['format'] }}"
                        :disabled="$smsOtpSent"
                        class="flex-1 sm:rounded-l-none min-h-[48px]"
                        :label="false"
                    />
                </div>

                <!-- Phone Number Preview -->
                @if($phoneNumber)
                    <div class="text-sm text-zinc-600 dark:text-zinc-400 break-all bg-zinc-50 dark:bg-zinc-800/50 rounded-lg p-3">
                        <span class="font-medium">Full number:</span> <span class="font-mono text-blue-600 dark:text-blue-400">{{ $this->getFullPhoneNumber() }}</span>
                    </div>
                @endif
            </div>

            @if($smsOtpSent)
                <!-- SMS OTP Code -->
                <div class="space-y-3">
                    <flux:input
                        wire:model="smsOtp"
                        :label="__('SMS OTP Code')"
                        type="text"
                        required
                        maxlength="6"
                        placeholder="000000"
                        class="text-center text-xl sm:text-2xl tracking-widest font-mono min-h-[56px]"
                    />

                    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <p class="font-medium mb-1">We've sent a 6-digit code to your phone number.</p>
                        <p>The code will expire in <strong class="text-red-600 dark:text-red-400">5 minutes</strong>.</p>
                    </div>

                    <!-- Improved Resend SMS OTP Button -->
                    <div class="text-center px-4">
                        @if($canSmsResend)
                            <button 
                                type="button" 
                                wire:click="sendSmsOtp" 
                                class="inline-flex items-center px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg font-medium transition-colors touch-manipulation"
                                :disabled="$isLoading"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Resend SMS OTP
                            </button>
                        @else
                            <div class="inline-flex items-center px-4 py-2 text-sm text-zinc-500 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-800 rounded-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Resend available in <span class="font-mono font-bold text-blue-600 dark:text-blue-400 ml-1">{{ $smsResendCountdown }}</span> seconds
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Try Others Option -->
            <div class="border-t border-zinc-200 dark:border-zinc-600 pt-4">
                <div class="text-center">
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">Having trouble with SMS OTP?</p>
                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                        <button 
                            type="button" 
                            wire:click="switchTab('password')" 
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Try Password Login
                        </button>
                        <button 
                            type="button" 
                            wire:click="switchTab('otp')" 
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 rounded-lg transition-colors"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Try Email OTP
                        </button>
                    </div>
                </div>
            </div>

            <!-- Remember Me (only show when SMS OTP is sent) -->
            @if($smsOtpSent)
                <flux:checkbox wire:model="remember" :label="__('Remember me')" />
            @endif

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full sm:w-auto px-8 py-4 text-sm sm:text-base font-medium min-h-[48px] sm:min-h-[44px]" :disabled="$isLoading">
                    @if($isLoading)
                        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    @endif
                    {{ $smsOtpSent ? __('Verify & Log in') : __('Send SMS OTP') }}
                </flux:button>
            </div>
        </form>
    @endif

    <!-- Social Authentication -->
    @include('livewire.auth.social-login')

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Don\'t have an account?') }}
            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
        </div>
    @endif
</div>
