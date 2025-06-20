<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Livewire\Livewire;

class SmsOtpAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_sms_otp(): void
    {
        Log::spy();

        $user = User::factory()->create([
            'phone_number' => '+15551234567',
        ]);

        Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('activeTab', 'sms')
            ->call('sendSmsOtp');

        Log::shouldHaveReceived('info')
            ->with('Mock SMS sent', \Mockery::on(function ($args) {
                return $args['phone'] === '+15551234567' && 
                       preg_match('/\d{6}/', $args['otp']);
            }));

        $this->assertDatabaseHas('users', [
            'phone_number' => '+15551234567',
            'sms_otp_code' => $user->fresh()->sms_otp_code,
        ]);
    }

    public function test_user_can_login_with_valid_sms_otp(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+15551234567',
            'sms_otp_code' => '123456',
            'sms_otp_expires_at' => now()->addMinutes(5),
        ]);

        Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('smsOtp', '123456')
            ->set('activeTab', 'sms')
            ->set('smsOtpSent', true)
            ->call('loginWithSmsOtp');

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_sms_otp(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+15551234567',
            'sms_otp_code' => '123456',
            'sms_otp_expires_at' => now()->addMinutes(5),
        ]);

        Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('smsOtp', '000000')
            ->set('activeTab', 'sms')
            ->set('smsOtpSent', true)
            ->call('loginWithSmsOtp')
            ->assertHasErrors(['smsOtp']);

        $this->assertGuest();
    }

    public function test_user_cannot_login_with_expired_sms_otp(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+15551234567',
            'sms_otp_code' => '123456',
            'sms_otp_expires_at' => now()->subMinutes(1),
        ]);

        Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('smsOtp', '123456')
            ->set('activeTab', 'sms')
            ->set('smsOtpSent', true)
            ->call('loginWithSmsOtp')
            ->assertHasErrors(['smsOtp']);

        $this->assertGuest();
    }

    public function test_sms_resend_countdown_functionality(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+15551234567',
        ]);

        $component = Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1')
            ->set('activeTab', 'sms')
            ->call('sendSmsOtp');

        $this->assertEquals(60, $component->get('smsResendCountdown'));
        $this->assertFalse($component->get('canSmsResend'));
    }

    public function test_invalid_phone_number_validation(): void
    {
        Livewire::test('auth.login')
            ->set('phoneNumber', 'invalid-phone')
            ->set('selectedCountryCode', '+1')
            ->set('activeTab', 'sms')
            ->call('sendSmsOtp')
            ->assertHasErrors(['phoneNumber']);
    }

    public function test_phone_number_not_found(): void
    {
        Livewire::test('auth.login')
            ->set('phoneNumber', '9999999999')
            ->set('selectedCountryCode', '+1')
            ->set('activeTab', 'sms')
            ->call('sendSmsOtp')
            ->assertHasErrors(['phoneNumber']);
    }

    public function test_country_code_selection(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->call('selectCountryCode', '+44');

        $this->assertEquals('+44', $component->get('selectedCountryCode'));
        $this->assertFalse($component->get('showCountryDropdown'));
    }

    public function test_toggle_country_dropdown(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->call('toggleCountryDropdown');

        $this->assertTrue($component->get('showCountryDropdown'));

        $component->call('toggleCountryDropdown');
        $this->assertFalse($component->get('showCountryDropdown'));
    }

    public function test_get_full_phone_number(): void
    {
        $component = Livewire::test('auth.login')
            ->set('phoneNumber', '5551234567')
            ->set('selectedCountryCode', '+1');

        $result = $component->call('getFullPhoneNumber');
        if ($result instanceof \Livewire\Features\SupportTesting\Testable) {
            $result = $result->effects['return'] ?? null;
        }
        $this->assertEquals('+15551234567', $result);
    }

    public function test_country_search_functionality(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->set('countrySearch', 'united');

        $result = $component->call('getFilteredCountries');
        if ($result instanceof \Livewire\Features\SupportTesting\Testable) {
            $countries = $result->effects['return'] ?? [];
        } else {
            $countries = $result;
        }
        $this->assertIsArray($countries);
        $this->assertGreaterThan(0, count($countries));
        
        // Should find United States and United Kingdom
        $countryCodes = collect($countries)->pluck('code')->toArray();
        $this->assertContains('+1', $countryCodes); // United States
        $this->assertContains('+44', $countryCodes); // United Kingdom
    }

    public function test_country_search_by_code(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->set('countrySearch', '+91');

        $result = $component->call('getFilteredCountries');
        if ($result instanceof \Livewire\Features\SupportTesting\Testable) {
            $countries = $result->effects['return'] ?? [];
        } else {
            $countries = $result;
        }
        $this->assertIsArray($countries);
        $this->assertEquals(1, count($countries));
        $this->assertEquals('+91', $countries[0]['code']);
    }

    public function test_country_search_no_results(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->set('countrySearch', 'nonexistentcountry');

        $result = $component->call('getFilteredCountries');
        if ($result instanceof \Livewire\Features\SupportTesting\Testable) {
            $countries = $result->effects['return'] ?? [];
        } else {
            $countries = $result;
        }
        $this->assertIsArray($countries);
        $this->assertEquals(0, count($countries));
    }

    public function test_clear_search_on_country_selection(): void
    {
        $component = Livewire::test('auth.login')
            ->set('activeTab', 'sms')
            ->set('countrySearch', 'united')
            ->call('selectCountryCode', '+44');

        $this->assertEquals('+44', $component->get('selectedCountryCode'));
        $this->assertEquals('', $component->get('countrySearch'));
        $this->assertFalse($component->get('showCountryDropdown'));
    }

    public function test_phone_number_formatting(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+15551234567',
        ]);

        $this->assertEquals('+1 (555) 123-4567', $user->formatted_phone_number);
    }

    public function test_phone_number_without_country_code_formatting(): void
    {
        $user = User::factory()->create([
            'phone_number' => '5551234567',
        ]);

        $this->assertEquals('(555) 123-4567', $user->formatted_phone_number);
    }
} 