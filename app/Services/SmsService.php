<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SmsService
{
    protected string $provider;
    protected array $config;

    public function __construct()
    {
        $this->provider = config('services.sms.provider', 'mock');
        $this->config = config('services.sms', []);
    }

    /**
     * Send OTP via SMS
     */
    public function sendOtp(string $phoneNumber, string $otp): bool
    {
        $message = "Your login OTP code is: {$otp}. Valid for 5 minutes. Do not share this code.";

        return match ($this->provider) {
            'twilio' => $this->sendViaTwilio($phoneNumber, $message),
            'aws' => $this->sendViaAws($phoneNumber, $message),
            'mock' => $this->sendViaMock($phoneNumber, $message),
            default => $this->sendViaMock($phoneNumber, $message),
        };
    }

    /**
     * Send SMS via Twilio
     */
    protected function sendViaTwilio(string $phoneNumber, string $message): bool
    {
        try {
            $response = Http::withBasicAuth(
                $this->config['twilio']['account_sid'],
                $this->config['twilio']['auth_token']
            )->post("https://api.twilio.com/2010-04-01/Accounts/{$this->config['twilio']['account_sid']}/Messages.json", [
                'To' => $phoneNumber,
                'From' => $this->config['twilio']['from_number'],
                'Body' => $message,
            ]);

            if ($response->successful()) {
                Log::info('SMS sent via Twilio', [
                    'phone' => $phoneNumber,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::error('Twilio SMS failed', [
                'phone' => $phoneNumber,
                'response' => $response->json(),
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('Twilio SMS exception', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Send SMS via AWS SNS
     */
    protected function sendViaAws(string $phoneNumber, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'X-Amz-Target' => 'SNS.Publish',
                'Content-Type' => 'application/x-amz-json-1.0',
            ])->post($this->config['aws']['endpoint'], [
                'Message' => $message,
                'PhoneNumber' => $phoneNumber,
            ]);

            if ($response->successful()) {
                Log::info('SMS sent via AWS SNS', [
                    'phone' => $phoneNumber,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::error('AWS SNS SMS failed', [
                'phone' => $phoneNumber,
                'response' => $response->json(),
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('AWS SNS SMS exception', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Mock SMS service for development
     */
    protected function sendViaMock(string $phoneNumber, string $message): bool
    {
        Log::info('Mock SMS sent', [
            'phone' => $phoneNumber,
            'message' => $message,
            'otp' => preg_replace('/[^0-9]/', '', $message),
        ]);

        // In development, we can also store the OTP in session for testing
        session()->flash('mock_sms_otp', preg_replace('/[^0-9]/', '', $message));
        session()->flash('mock_sms_phone', $phoneNumber);

        return true;
    }

    /**
     * Validate phone number format
     */
    public function validatePhoneNumber(string $phoneNumber): bool
    {
        // Remove all non-digit characters
        $clean = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Check for valid US phone number (10 or 11 digits)
        if (strlen($clean) === 10) {
            return true;
        }
        
        if (strlen($clean) === 11 && substr($clean, 0, 1) === '1') {
            return true;
        }
        
        return false;
    }

    /**
     * Format phone number for SMS service
     */
    public function formatPhoneNumber(string $phoneNumber): string
    {
        $clean = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // If 10 digits, add +1
        if (strlen($clean) === 10) {
            return '+1' . $clean;
        }
        
        // If 11 digits and starts with 1, add +
        if (strlen($clean) === 11 && substr($clean, 0, 1) === '1') {
            return '+' . $clean;
        }
        
        return $phoneNumber;
    }
} 