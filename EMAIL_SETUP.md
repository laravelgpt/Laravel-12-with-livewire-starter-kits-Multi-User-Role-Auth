# Email Configuration Guide - Fix Spam Classification Issues

## 🚨 Current Issue
You're getting error code "550" with message "550 This message was classified as SPAM and may not be delivered". This is a common issue when sending emails through SMTP servers.

## 🔧 Solutions

### Solution 1: Development Mode (Recommended for Testing)
For development and testing, use the log driver to avoid spam issues:

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Laravel 12 Auth"
```

**Benefits:**
- No spam classification issues
- Emails are logged to `storage/logs/laravel.log`
- Perfect for development and testing
- No external dependencies

### Solution 2: Use a Professional Email Service

#### Option A: Gmail SMTP (Free)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Your App Name"
```

**Setup:**
1. Enable 2-factor authentication on your Gmail account
2. Generate an App Password: Google Account → Security → App Passwords
3. Use the App Password instead of your regular password

#### Option B: Mailgun (Free tier available)
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-api-key
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="Your App Name"
```

#### Option C: Postmark (Recommended for production)
```env
MAIL_MAILER=postmark
POSTMARK_TOKEN=your-postmark-token
MAIL_FROM_ADDRESS=verified@yourdomain.com
MAIL_FROM_NAME="Your App Name"
```

#### Option D: SendGrid (Free tier available)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Your App Name"
```

### Solution 3: Local Development with Mailpit
For local development with a visual email interface:

```env
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Laravel 12 Auth"
```

**Install Mailpit:**
```bash
# Windows (using Chocolatey)
choco install mailpit

# macOS (using Homebrew)
brew install mailpit

# Linux
# Download from https://github.com/axllent/mailpit/releases
```

## 🛡️ Spam Prevention Best Practices

### 1. Proper Email Headers
The system now includes:
- Professional email template
- Unsubscribe link
- Proper sender information
- Clear subject lines

### 2. Domain Authentication
For production, set up:
- SPF records
- DKIM authentication
- DMARC policy

### 3. Content Best Practices
- Avoid spam trigger words
- Use proper HTML structure
- Include unsubscribe options
- Maintain good text-to-HTML ratio

## 🚀 Quick Setup Commands

### For Development (Log Driver)
```bash
# Clear config cache
php artisan config:clear

# Test email sending
php artisan tinker
Mail::raw('Test email', function($message) { $message->to('test@example.com')->subject('Test'); });
```

### For Production (Gmail Example)
```bash
# Update .env file with Gmail settings
# Generate app password from Google Account
# Test email sending
php artisan tinker
Mail::raw('Test email', function($message) { $message->to('test@example.com')->subject('Test'); });
```

## 📧 Testing Email Verification

1. **Register a new user**
2. **Check email logs** (if using log driver):
   ```bash
   tail -f storage/logs/laravel.log
   ```
3. **Verify the email** by clicking the link in the log
4. **Check user verification status**:
   ```bash
   php artisan tinker
   User::where('email', 'test@example.com')->first()->hasVerifiedEmail()
   ```

## 🔍 Troubleshooting

### Common Issues:

1. **"550 SPAM" Error**: Use log driver for development
2. **Authentication Failed**: Check credentials and app passwords
3. **Connection Timeout**: Verify SMTP settings and firewall
4. **Emails Not Sending**: Check mail configuration and logs

### Debug Commands:
```bash
# Check mail configuration
php artisan config:show mail

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Test mail configuration
php artisan tinker
config('mail')
```

## 📝 Environment Variables Template

Copy this to your `.env` file:

```env
# Development (Log Driver)
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Laravel 12 Auth"

# OR Production (Gmail Example)
# MAIL_MAILER=smtp
# MAIL_HOST=smtp.gmail.com
# MAIL_PORT=587
# MAIL_USERNAME=your-email@gmail.com
# MAIL_PASSWORD=your-app-password
# MAIL_ENCRYPTION=tls
# MAIL_FROM_ADDRESS=your-email@gmail.com
# MAIL_FROM_NAME="Your App Name"
```

## ✅ Recommended Setup for Your Case

Since you're getting spam classification errors, I recommend:

1. **For Development**: Use the log driver (already configured)
2. **For Production**: Use a professional email service like Postmark or SendGrid
3. **For Testing**: Use Mailpit for local development

The system is now configured to work with any of these options. Just update your `.env` file with the appropriate settings! 