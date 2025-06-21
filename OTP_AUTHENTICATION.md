# OTP Authentication Feature

This Laravel 12 application now includes a dual authentication system with both traditional email/password login and email OTP (One-Time Password) authentication.

## Features

### 🔐 Dual Authentication Methods
- **Email & Password**: Traditional login with email and password
- **Email OTP**: Passwordless login using 6-digit codes sent via email

### 🎨 Modern Tabbed Interface
- Clean, responsive tab navigation between authentication methods
- Smooth transitions and loading states
- Consistent with the existing design system

### 🔒 Security Features
- 6-digit OTP codes with 5-minute expiration
- Rate limiting on authentication attempts
- Secure email delivery with professional templates
- Automatic cleanup of expired OTP codes
- Smart resend functionality with countdown timer

### ⏱️ Improved Resend Experience
- 60-second cooldown between resend requests
- Real-time countdown timer
- Prevents spam and abuse
- Visual feedback with icons and timers

## How It Works

### Email & Password Authentication
1. User enters email and password
2. System validates credentials against database
3. User is logged in and redirected to dashboard

### Email OTP Authentication
1. User enters email address
2. System generates 6-digit OTP and sends via email
3. User enters the OTP code
4. System verifies OTP and logs user in
5. Resend option available after 60-second cooldown

## Database Changes

The following fields were added to the `users` table:
- `otp_code` (string, nullable): Stores the current OTP
- `otp_expires_at` (timestamp, nullable): OTP expiration time
- `otp_verified` (boolean): Whether OTP was successfully verified

## Email Template

A professional email template is included at `resources/views/emails/otp.blade.php` with:
- Clean, responsive design
- Clear OTP display with proper spacing
- Security warnings and 5-minute expiration information
- Branded styling

## Usage

### For Users
1. Navigate to the login page
2. Choose between "Email & Password" or "Email OTP" tabs
3. For OTP login:
   - Enter email address
   - Click "Send OTP"
   - Check email for 6-digit code (expires in 5 minutes)
   - Enter code and click "Verify & Log in"
   - Use "Resend OTP" if needed (60-second cooldown)

### For Developers
The OTP functionality is integrated into the existing User model:

```php
// Generate and send OTP (expires in 5 minutes)
$user->generateOtp();

// Verify OTP
if ($user->verifyOtp($otpCode)) {
    // OTP is valid
}

// Check if OTP is expired
if ($user->isOtpExpired()) {
    // OTP has expired
}
```

## Configuration

### Mail Configuration
Ensure your mail configuration is properly set up in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourapp.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Rate Limiting
The OTP system uses the same rate limiting as password authentication:
- 5 attempts per email/IP combination
- Automatic lockout after exceeding limits
- 60-second cooldown between resend requests

## Testing

Run the included tests to verify OTP functionality:

```bash
php artisan test --filter=OtpAuthenticationTest
```

## Security Considerations

1. **OTP Expiration**: OTP codes expire after 5 minutes
2. **Rate Limiting**: Prevents brute force attacks
3. **Email Security**: OTP codes are sent via secure email
4. **Database Security**: OTP codes are hashed and not stored in plain text
5. **Session Management**: Proper session regeneration on login
6. **Resend Protection**: 60-second cooldown prevents spam

## Future Enhancements

Potential improvements for the OTP system:
- SMS OTP delivery option
- TOTP (Time-based One-Time Password) support
- Backup codes for account recovery
- OTP history tracking
- Customizable OTP expiration times
- Advanced rate limiting per user 