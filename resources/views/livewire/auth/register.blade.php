<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $emailSent = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Send email verification
        $user->sendEmailVerificationNotification();

        // Log in the user
        Auth::login($user);

        // Fire the registered event
        event(new Registered($user));

        // Redirect to dashboard
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Resend email verification
     */
    public function resendVerification(): void
    {
        // Email verification is not required, so this method is no longer needed
        session()->flash('status', 'Email verification is not required for this application.');
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
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

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            placeholder="••••••••"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm Password')"
            type="password"
            required
            autocomplete="new-password"
            placeholder="••••••••"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">
                {{ __('Register') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('login'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Already have an account?') }}
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    @endif
</div>
