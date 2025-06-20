<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Services\SmsService;
use App\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'phone_number',
        'otp_code',
        'otp_expires_at',
        'otp_verified',
        'sms_otp_code',
        'sms_otp_expires_at',
        'sms_otp_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
        'sms_otp_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
            'otp_verified' => 'boolean',
            'sms_otp_expires_at' => 'datetime',
            'sms_otp_verified' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Generate and send OTP to user
     */
    public function generateOtp(): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified' => false,
        ]);

        // Send OTP via email
        Mail::to($this->email)->send(new OtpMail($otp));

        return $otp;
    }

    /**
     * Verify OTP code
     */
    public function verifyOtp(string $otp): bool
    {
        if ($this->otp_code === $otp && 
            $this->otp_expires_at && 
            $this->otp_expires_at->isFuture()) {
            
            $this->update([
                'otp_verified' => true,
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            return true;
        }

        return false;
    }

    /**
     * Check if OTP is expired
     */
    public function isOtpExpired(): bool
    {
        return !$this->otp_expires_at || $this->otp_expires_at->isPast();
    }

    /**
     * Generate and send SMS OTP to user
     */
    public function generateSmsOtp(): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->update([
            'sms_otp_code' => $otp,
            'sms_otp_expires_at' => now()->addMinutes(5),
            'sms_otp_verified' => false,
        ]);

        // Send SMS OTP
        $smsService = app(SmsService::class);
        $smsService->sendOtp($this->phone_number, $otp);

        return $otp;
    }

    /**
     * Verify SMS OTP code
     */
    public function verifySmsOtp(string $otp): bool
    {
        if ($this->sms_otp_code === $otp && 
            $this->sms_otp_expires_at && 
            $this->sms_otp_expires_at->isFuture()) {
            
            $this->update([
                'sms_otp_verified' => true,
                'sms_otp_code' => null,
                'sms_otp_expires_at' => null,
            ]);

            return true;
        }

        return false;
    }

    /**
     * Check if SMS OTP is expired
     */
    public function isSmsOtpExpired(): bool
    {
        return !$this->sms_otp_expires_at || $this->sms_otp_expires_at->isPast();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    /**
     * Format phone number for display
     */
    public function getFormattedPhoneNumberAttribute(): string
    {
        if (!$this->phone_number) {
            return '';
        }

        // Basic phone number formatting
        $phone = preg_replace('/[^0-9]/', '', $this->phone_number);
        
        if (strlen($phone) === 10) {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
        }
        
        if (strlen($phone) === 11 && substr($phone, 0, 1) === '1') {
            return '+1 (' . substr($phone, 1, 3) . ') ' . substr($phone, 4, 3) . '-' . substr($phone, 7);
        }
        
        return $this->phone_number;
    }
}
