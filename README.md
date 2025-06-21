# Laravel 12 Authentication Project

## Recent Updates

- Updated country codes to include 200+ countries.
- Removed sensitive information from the commit history.
- Tagged the version as v4.0.

## Setup Instructions

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your environment variables.
4. Run `php artisan migrate` to set up the database.
5. Start the development server with `php artisan serve`.

## Features

- **Authentication and User Roles Management**: Secure authentication with Laravel Sanctum and customizable user roles.
- **Social Authentication**: Supports OAuth providers for social logins, automatically creating or updating users with social provider information, and assigning roles.
- **OTP Authentication**: Generates and sends OTP via email and SMS, with verification and expiration checks.
- **Email Verification**: Sends email verification notifications to ensure account security.
- **Multi-language Support**: Dynamic translation loader for multiple languages.
- **Multi-currency Support**: Automatic exchange rate synchronization.
- **Real-time Broadcasting**: Integration with Pusher/Laravel Echo for real-time updates.
- **Cursor Tracking**: Advanced cursor tracking for analytics and UX feedback.
- **Screen Recording**: Optional screen recording for user sessions.
- **Accessibility**: ARIA roles for cursor-over elements.
- **AI Analysis**: AI-driven analysis of cursor paths for UX improvements.
- **Rate Limiting**: Configurable rate limiting for APIs to prevent abuse.
- **Secure Data Handling**: Uses hashed passwords and secure storage for sensitive data.
- **Environment Configuration**: Secure management of environment variables.

## Contributing

Please read `CONTRIBUTING.md` for details on our code of conduct, and the process for submitting pull requests. 