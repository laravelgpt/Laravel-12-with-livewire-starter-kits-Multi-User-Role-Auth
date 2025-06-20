<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register');

        $this->assertAuthenticated();

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('+15551234567', $user->phone_number);
    }

    public function test_registration_requires_phone_number(): void
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertHasErrors(['phoneNumber']);
    }

    public function test_registration_with_different_country_code(): void
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('phoneNumber', '712345678')
            ->set('selectedCountryCode', '+44')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register');

        $this->assertAuthenticated();

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('+44712345678', $user->phone_number);
    }

    public function test_country_code_selection_works(): void
    {
        $component = Livewire::test('auth.register')
            ->call('selectCountryCode', '+44');

        $this->assertEquals('+44', $component->get('selectedCountryCode'));
        $this->assertFalse($component->get('showCountryDropdown'));
    }

    public function test_get_full_phone_number(): void
    {
        $component = Livewire::test('auth.register')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1');

        $result = $component->call('getFullPhoneNumber');
        $this->assertEquals('+15551234567', $result);
    }
} 