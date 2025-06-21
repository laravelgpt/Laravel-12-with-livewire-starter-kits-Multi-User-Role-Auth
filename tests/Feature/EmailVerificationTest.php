<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_receive_verification_email(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->post('/livewire/message/register', [
            'fingerprint' => [
                'id' => 'register',
                'name' => 'register',
                'locale' => 'en',
                'path' => 'register',
                'method' => 'register',
            ],
            'serverMemo' => [
                'children' => [],
                'errors' => [],
                'htmlHash' => '',
                'data' => [
                    'name' => '',
                    'email' => '',
                    'phoneNumber' => '',
                    'selectedCountryCode' => '+1',
                    'password' => '',
                    'password_confirmation' => '',
                    'showCountryDropdown' => false,
                    'countrySearch' => '',
                    'emailSent' => false,
                ],
                'dataMeta' => [],
                'checksum' => '',
            ],
            'updates' => [
                [
                    'type' => 'callMethod',
                    'payload' => [
                        'id' => 'register',
                        'method' => 'register',
                        'params' => [
                            'name' => 'Test User',
                            'email' => 'test@example.com',
                            'phoneNumber' => '1234567890',
                            'password' => 'password',
                            'password_confirmation' => 'password',
                        ],
                    ],
                ],
            ],
        ]);

        $response->assertStatus(200);
        
        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertNull($user->email_verified_at);
    }

    public function test_user_can_verify_email(): void
    {
        Event::fake();

        /** @var User $user */
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect(route('dashboard') . '?verified=1');

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        Event::assertDispatched(Verified::class);
    }

    public function test_user_cannot_verify_with_invalid_hash(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => 'invalid-hash']
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertStatus(403);
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_user_can_resend_verification_email(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_verified_user_cannot_verify_again(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect(route('dashboard') . '?verified=1');
    }
} 