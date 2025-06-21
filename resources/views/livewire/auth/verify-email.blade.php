<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Redirect to dashboard since email verification is not required
     */
    public function mount(): void
    {
        // Redirect to dashboard since email verification is not required
        $this->redirect(route('dashboard'), navigate: true);
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="mt-4 flex flex-col gap-6">
    <flux:text class="text-center">
        {{ __('Email verification is not required. Redirecting to dashboard...') }}
    </flux:text>

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button wire:click="logout" variant="secondary" class="w-full">
            {{ __('Log out') }}
        </flux:button>
    </div>
</div>
