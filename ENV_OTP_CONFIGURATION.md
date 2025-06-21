# OTP Authentication Environment Configuration Guide

## Current Configuration Status

Your current `.env` file has basic settings, but needs updates for proper OTP email delivery and SMS functionality. Here's what you need to configure:

## 🔧 Required Updates

### 1. Mail Configuration (CRITICAL for Email OTP)

**Current Setting:**
```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Recommended for Development:**
```env
# For Development (emails logged to storage/logs/laravel.log)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@servertheme.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**For Production - Choose ONE option:**

#### Option A: SMTP (Gmail, Outlook, etc.)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Option B: Mailtrap (for testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Option C: Postmark
```env
MAIL_MAILER=postmark
POSTMARK_TOKEN=your-postmark-token
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Option D: AWS SES
```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=your-aws-access-key
AWS_SECRET_ACCESS_KEY=your-aws-secret-key
AWS_DEFAULT_REGION=us-east-1
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Option E: Resend
```env
MAIL_MAILER=resend
RESEND_KEY=your-resend-api-key
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. SMS Configuration (CRITICAL for SMS OTP)

**For Development (Mock SMS):**
```env
# Mock SMS service (logs to storage/logs/laravel.log)
SMS_PROVIDER=mock
```

**For Production - Choose ONE option:**

#### Option A: Twilio
```env
SMS_PROVIDER=twilio
TWILIO_ACCOUNT_SID=your_twilio_account_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_FROM_NUMBER=+1234567890
```

#### Option B: AWS SNS
```env
SMS_PROVIDER=aws
AWS_ACCESS_KEY_ID=your-aws-access-key
AWS_SECRET_ACCESS_KEY=your-aws-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_SNS_ENDPOINT=https://sns.us-east-1.amazonaws.com
```

### 3. OTP-Specific Settings (Optional)

Add these to your `.env` file for customizing OTP behavior:

```env
# OTP expiration time in minutes (default: 5)
OTP_EXPIRATION_MINUTES=5

# OTP code length (default: 6)
OTP_CODE_LENGTH=6

# Rate limiting for OTP requests (attempts per minute)
OTP_RATE_LIMIT=5

# Resend cooldown in seconds (default: 60)
OTP_RESEND_COOLDOWN=60
```

## 🚀 Quick Setup Commands

After updating your `.env` file, run these commands:

```bash
# Clear configuration cache
php artisan config:clear

# Clear application cache
php artisan cache:clear

# Restart the development server
php artisan serve
```

## 📧 Testing Email Configuration

### For Development (Log Driver)
1. Update your `.env` with the log driver settings
2. Send an OTP from the login page
3. Check `storage/logs/laravel.log` for the email content

### For Production (SMTP/Other Services)
1. Configure your chosen mail service
2. Test by sending an OTP from the login page
3. Check your email inbox for the OTP code

## 📱 Testing SMS Configuration

### For Development (Mock SMS)
1. Update your `.env` with `SMS_PROVIDER=mock`
2. Send an SMS OTP from the login page
3. Check `storage/logs/laravel.log` for the SMS content
4. Check session for mock OTP: `session('mock_sms_otp')`

### For Production (Twilio/AWS)
1. Configure your chosen SMS service
2. Test by sending an SMS OTP from the login page
3. Check your phone for the SMS OTP code

## 🔍 Verification Steps

1. **Check Current Mail Configuration:**
   ```bash
   php artisan tinker
   >>> config('mail')
   ```

2. **Check Current SMS Configuration:**
   ```bash
   php artisan tinker
   >>> config('services.sms')
   ```

3. **Test Mail Configuration:**
   ```bash
   php artisan tinker
   >>> Mail::raw('Test email', function($message) { $message->to('test@example.com')->subject('Test'); });
   ```

4. **Test SMS Configuration:**
   ```bash
   php artisan tinker
   >>> app(\App\Services\SmsService::class)->sendOtp('+1234567890', '123456');
   ```

5. **Check OTP Functionality:**
   - Go to `/login`
   - Click "Email OTP" tab
   - Enter your email
   - Click "Send OTP"
   - Check your email or logs

6. **Check SMS OTP Functionality:**
   - Go to `/login`
   - Click "SMS OTP" tab
   - Enter your phone number
   - Click "Send SMS OTP"
   - Check your phone or logs

## 🛠️ Troubleshooting

### Common Issues:

1. **Emails not sending:**
   - Check mail configuration in `.env`
   - Verify SMTP credentials
   - Check firewall/port settings

2. **SMS not sending:**
   - Check SMS provider configuration
   - Verify Twilio/AWS credentials
   - Check phone number format

3. **OTP not received:**
   - Check spam folder (email)
   - Verify email/phone address is correct
   - Check mail/SMS logs: `storage/logs/laravel.log`

4. **Rate limiting issues:**
   - Wait 1 minute between OTP requests
   - Check rate limit configuration

### Debug Commands:
```bash
# Check mail configuration
php artisan config:show mail

# Check SMS configuration
php artisan config:show services.sms

# Clear all caches
php artisan optimize:clear

# Check application logs
tail -f storage/logs/laravel.log
```

## 📋 Complete .env Template

Here's a complete template for your `.env` file with OTP and SMS support:

```env
APP_NAME=Servertheme
APP_ENV=local
APP_KEY=base64:PCJs8GWi4AeLQ5362ov9FSQHSkkEo14QBqiHINsS79Y=
APP_DEBUG=true
APP_URL=http://laravel-12-auth.test

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# Database Configuration
DB_CONNECTION=sqlite

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database

# Redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail Configuration for Email OTP
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@servertheme.com"
MAIL_FROM_NAME="${APP_NAME}"

# SMS Configuration for SMS OTP
SMS_PROVIDER=mock

# Twilio Configuration (for production)
# TWILIO_ACCOUNT_SID=your_twilio_account_sid
# TWILIO_AUTH_TOKEN=your_twilio_auth_token
# TWILIO_FROM_NUMBER=+1234567890

# OTP Settings
OTP_EXPIRATION_MINUTES=5
OTP_CODE_LENGTH=6
OTP_RATE_LIMIT=5
OTP_RESEND_COOLDOWN=60

# AWS (if using SES or SNS)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## ✅ Next Steps

1. Update your `.env` file with the appropriate mail and SMS configuration
2. Test both Email OTP and SMS OTP functionality
3. Configure production mail and SMS settings when deploying
4. Monitor email and SMS delivery and OTP success rates 