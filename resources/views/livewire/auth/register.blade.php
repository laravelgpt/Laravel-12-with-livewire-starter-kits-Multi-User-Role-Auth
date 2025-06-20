<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phoneNumber = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $selectedCountryCode = '+966';
    public bool $showCountryDropdown = false;
    public string $countrySearch = '';
    public bool $emailSent = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phoneNumber' => ['required', 'phone:' . ($this->getSelectedCountry()['iso'] ?? 'AUTO')],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['phone_number'] = $this->fullPhoneNumber;

        $user = User::create($validated);

        // Send email verification
        $user->sendEmailVerificationNotification();

        $this->emailSent = true;

        session()->flash('status', 'Registration successful! Please check your email for a verification link.');
    }

    /**
     * Resend email verification
     */
    public function resendVerification(): void
    {
        // Email verification is not required, so this method is no longer needed
        session()->flash('status', 'Email verification is not required for this application.');
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
    #[Computed(persist: true)]
    public function fullPhoneNumber(): string
    {
        $phoneNumber = ltrim($this->phoneNumber, '0');

        return $this->selectedCountryCode . $phoneNumber;
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
        return $country ?: ['code' => '+1', 'name' => 'United States', 'flag' => '🇺🇸', 'format' => '(555) 123-4567', 'iso' => 'US'];
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
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6" wire:click.self="closeDropdown">
        @if(!$emailSent)
            <!-- Name -->
            <flux:input
                wire:model="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Full name')"
            />

            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

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
                            class="w-full sm:w-auto min-w-[120px] flex items-center justify-between px-4 py-3 text-sm border rounded-lg sm:rounded-r-none bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 hover:bg-zinc-50 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors touch-manipulation @error('phoneNumber') border-red-500 @else border-zinc-300 dark:border-zinc-600 @enderror"
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
                        autocomplete="tel"
                        placeholder="{{ $this->getSelectedCountry()['format'] }}"
                        class="flex-1 sm:rounded-l-none min-h-[48px]"
                        :label="false"
                    />
                </div>
                
                <flux:error name="phoneNumber" class="mt-2" />

                @if($this->phoneNumber)
                <div class="p-2 bg-gray-100 rounded-md dark:bg-zinc-800">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Full number: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $this->fullPhoneNumber }}</span></p>
                </div>
                @endif
            </div>

            <!-- Password -->
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Password')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm password')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full sm:w-auto px-8 py-4 text-sm sm:text-base font-medium min-h-[48px] sm:min-h-[44px]">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        @else
            <!-- Email Verification Sent -->
            <div class="text-center space-y-6">
                <div class="mx-auto w-16 h-16 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Check your email') }}
                    </h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ __('We\'ve sent a verification link to') }} <strong>{{ $email }}</strong>
                    </p>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ __('Click the link in the email to verify your account and complete registration.') }}
                    </p>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-blue-800 dark:text-blue-200">
                            <p class="font-medium mb-1">{{ __('Didn\'t receive the email?') }}</p>
                            <p>{{ __('Check your spam folder or') }} 
                                <button type="button" wire:click="resendVerification" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                    {{ __('click here to resend') }}
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <flux:button variant="secondary" :href="route('login')" wire:navigate class="w-full sm:w-auto">
                        {{ __('Back to login') }}
                    </flux:button>
                    <flux:button variant="primary" wire:click="resendVerification" class="w-full sm:w-auto">
                        {{ __('Resend verification email') }}
                    </flux:button>
                </div>
            </div>
        @endif
    </form>

    <!-- Social Authentication with Role Options -->
    @include('livewire.auth.social-login', ['showRoleOptions' => true])

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
