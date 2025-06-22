# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.1.0] - 2025-01-20

### 🚀 Added
- **Enhanced Login Experience**
  - "Try Others" option in Email OTP Authentication tab
  - "Try Others" option in SMS OTP Authentication tab  
  - "Try Others" option in Password Authentication tab
  - Seamless switching between authentication methods
  - Improved user experience when having trouble with specific login methods

### 🔧 Changed
- **Login Interface Improvements**
  - Added helpful prompts for alternative authentication methods
  - Consistent "Try Others" UI across all authentication tabs
  - Better visual separation with border dividers
  - Responsive button layout for mobile and desktop
  - **Hidden main tab navigation** - users now access different methods through "Try Others" buttons
  - Updated header description to reflect new navigation approach
  - **Enhanced Email OTP "Try Others" section** with helpful tips and troubleshooting guidance
  - Added informative Email OTP authentication description before sending OTP
  - Improved OTP input field with better styling and auto-focus functionality
  - Added success message with email address confirmation
  - Included contact support option for users still having issues

### 🐛 Fixed
- Enhanced tab switching to properly reset OTP states
- Improved error handling when switching between authentication methods

## [3.0.0] - 2025-01-20

### 🚀 Added
- **Enhanced Authentication Features**
  - OTP (One-Time Password) authentication system
  - SMS OTP authentication with multiple providers (Mock, Twilio, AWS)
  - Email OTP verification system
  - Phone number validation with country codes
  - Comprehensive OTP management and verification

- **New Services & Notifications**
  - `SmsService` for SMS delivery with provider abstraction
  - `OtpMail` for email OTP delivery
  - `VerifyEmailNotification` for custom email verification
  - Country code configuration with 195+ countries

- **Database Enhancements**
  - OTP fields (`otp_code`, `otp_expires_at`, `otp_verified`)
  - SMS OTP fields (`sms_otp_code`, `sms_otp_expires_at`, `sms_otp_verified`)
  - Phone number field for SMS authentication
  - Migration files for OTP and SMS features

- **Testing & Documentation**
  - Comprehensive OTP authentication tests
  - SMS OTP authentication tests
  - Email verification tests
  - Detailed setup documentation for OTP and SMS

### 🔧 Changed
- **Removed Email Verification for Social Login**
  - Google and Facebook login users no longer require email verification
  - Updated User model to remove `MustVerifyEmail` interface
  - Modified `SocialiteController` to not auto-verify social users
  - Removed `verified` middleware from protected routes
  - All users are now treated as verified for statistics

- **Enhanced User Experience**
  - Immediate access to application after Google login
  - No email verification prompts for social users
  - Streamlined authentication flow
  - Updated profile settings to remove verification UI

- **Controller Updates**
  - Updated `DashboardController` to handle no email verification
  - Modified API controllers to treat all users as active
  - Updated `VerifyEmailController` to redirect to dashboard
  - Enhanced `UserController` API endpoints

### 🐛 Fixed
- Email verification blocking social login users
- Middleware conflicts with social authentication
- Statistics showing incorrect verification rates
- UI elements showing verification prompts unnecessarily

### 📚 Documentation
- Added `OTP_AUTHENTICATION.md` with detailed OTP setup
- Created `EMAIL_SETUP.md` for email configuration
- Added `ENV_OTP_CONFIGURATION.md` for OTP environment setup
- Updated `ENV_EMAIL_FIX.txt` for email troubleshooting

### 🛠️ Technical Improvements
- Optimized authentication flow for social users
- Enhanced error handling for OTP systems
- Improved code organization and separation of concerns
- Better abstraction for SMS and email services

## [2.0.0] - 2025-06-19

### 🚀 Added
- **Social Authentication System**
  - Google OAuth integration with authentic brand colors
  - Facebook OAuth integration with official brand styling
  - Role-based social registration (Seller, Wholeseller)
  - Automatic email verification for social users
  - Social provider information storage

- **Enhanced UI/UX**
  - Beautiful social login buttons with authentic brand colors
  - Smooth hover animations and transitions
  - Improved button spacing and typography
  - Modern rounded corners and shadow effects
  - Responsive design for all screen sizes

- **New Controllers & Routes**
  - `SocialiteController` for handling OAuth flows
  - Social authentication routes with role support
  - API endpoints for social authentication
  - Role-specific OAuth redirects

- **Database Enhancements**
  - Social authentication fields (`provider`, `provider_id`)
  - Migration for social user data
  - Indexed social provider fields for performance

- **Configuration & Setup**
  - Comprehensive environment configuration
  - Automated setup scripts for Windows and Linux/Mac
  - Detailed social authentication setup guide
  - Production-ready configuration examples

### 🔧 Changed
- **Simplified Provider Support**
  - Removed Twitter, GitHub, Apple, and Telegram providers
  - Focused on Google and Facebook (most popular providers)
  - Cleaner, more maintainable codebase
  - Reduced configuration complexity

- **Updated Documentation**
  - Comprehensive README with v2.0 features
  - Social authentication setup guide
  - API documentation updates
  - Deployment instructions

- **Enhanced Security**
  - Secure OAuth callback handling
  - Rate limiting for social authentication
  - CSRF protection for all forms
  - Input validation and sanitization

### 🐛 Fixed
- Route parameter handling for social authentication
- Environment variable configuration
- Database migration issues
- UI component styling inconsistencies

### 📚 Documentation
- Added `SOCIAL_AUTH_SETUP.md` with detailed provider setup
- Updated `README.md` with v2.0 features and quick start guide
- Created `ENV_CONFIGURATION.txt` for easy environment setup
- Added setup scripts with clear instructions

### 🛠️ Technical Improvements
- Optimized social authentication flow
- Improved error handling and user feedback
- Enhanced code organization and structure
- Better separation of concerns

## [1.0.0] - 2025-06-18

### 🚀 Initial Release
- **Laravel 12 Multi-Role Authentication System**
  - Complete authentication flow with email verification
  - Multi-role system (Admin, Staff, User, Customer, Wholeseller, Seller)
  - Role-based access control with Spatie Permission
  - Password reset and confirmation functionality

- **Modern UI with Livewire 3**
  - Real-time, dynamic interfaces
  - Tailwind CSS for responsive design
  - Dark mode support
  - Mobile-optimized layouts

- **Admin Dashboard**
  - User management interface
  - Role assignment and management
  - System analytics and reporting
  - Settings and configuration

- **API System**
  - RESTful API endpoints
  - User management APIs
  - Dashboard statistics APIs
  - Role and permission APIs

- **Security Features**
  - CSRF protection
  - Rate limiting
  - Input validation
  - Secure session handling

- **Testing**
  - Comprehensive test suite with Pest PHP
  - Authentication tests
  - Feature tests
  - Unit tests

---

## Version History

- **v3.0.0** - Remove email verification for Google login and enhanced OTP/SMS authentication
- **v2.0.0** - Enhanced social authentication with Google & Facebook OAuth
- **v1.0.0** - Initial Laravel 12 multi-role authentication system

## Migration Guide

### From v1.0 to v2.0

1. **Update Dependencies**
   ```bash
   composer require laravel/socialite
   ```

2. **Run New Migrations**
   ```bash
   php artisan migrate
   ```

3. **Update Environment Configuration**
   ```bash
   cp ENV_CONFIGURATION.txt .env
   # Update with your OAuth credentials
   ```

4. **Clear Caches**
   ```bash
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

5. **Configure Social Authentication**
   - Set up Google OAuth application
   - Set up Facebook OAuth application
   - Update `.env` with credentials

## Support

For issues and questions:
- Create an issue on GitHub
- Check the documentation
- Review the setup guides 