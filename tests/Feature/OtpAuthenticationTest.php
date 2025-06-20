<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Tests\TestCase;
use Livewire\Livewire;

class OtpAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_otp(): void
    {
        Mail::fake();

        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        Livewire::test('auth.login')
            ->set('email', 'test@example.com')
            ->set('activeTab', 'otp')
            ->call('sendOtp');

        Mail::assertSent(OtpMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'otp_code' => $user->fresh()->otp_code,
        ]);
    }

    public function test_user_can_login_with_valid_otp(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'otp_code' => '123456',
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Livewire::test('auth.login')
            ->set('email', 'test@example.com')
            ->set('otp', '123456')
            ->set('activeTab', 'otp')
            ->set('otpSent', true)
            ->call('loginWithOtp');

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_otp(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'otp_code' => '123456',
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Livewire::test('auth.login')
            ->set('email', 'test@example.com')
            ->set('otp', '000000')
            ->set('activeTab', 'otp')
            ->set('otpSent', true)
            ->call('loginWithOtp')
            ->assertHasErrors(['otp']);

        $this->assertGuest();
    }

    public function test_user_cannot_login_with_expired_otp(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'otp_code' => '123456',
            'otp_expires_at' => now()->subMinutes(1),
        ]);

        Livewire::test('auth.login')
            ->set('email', 'test@example.com')
            ->set('otp', '123456')
            ->set('activeTab', 'otp')
            ->set('otpSent', true)
            ->call('loginWithOtp')
            ->assertHasErrors(['otp']);

        $this->assertGuest();
    }

    public function test_resend_countdown_functionality(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $component = Livewire::test('auth.login')
            ->set('email', 'test@example.com')
            ->set('activeTab', 'otp')
            ->call('sendOtp');

        $this->assertEquals(60, $component->get('resendCountdown'));
        $this->assertFalse($component->get('canResend'));
    }
} 