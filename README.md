# Laravel 12 Multi-Role Auth v5.0 🚀

A modern Laravel 12 application with Livewire, multi-user role authentication, enhanced social authentication, and advanced OTP authentication system featuring Email and SMS verification.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![Livewire](https://img.shields.io/badge/Livewire-3.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## ✨ Features

### 🔐 Authentication & Authorization
- **Multi-Role System**: Admin, Staff, User, Customer, Wholeseller, Seller
- **Social Authentication**: Google OAuth & Facebook OAuth
- **Advanced OTP Authentication**: Email OTP and SMS OTP with enhanced UX
- **Role-based Access Control**: Granular permissions with Spatie Permission
- **Email Verification**: Built-in email verification system
- **Password Reset**: Secure password reset functionality

### 🎨 Modern UI/UX
- **Livewire 3**: Real-time, dynamic interfaces
- **Tailwind CSS**: Modern, responsive design
- **Flux Components**: Beautiful, accessible UI components
- **Dark Mode Support**: Toggle between light and dark themes
- **Mobile Responsive**: Works perfectly on all devices
- **Enhanced Login Experience**: Hidden tab navigation with "Try Others" options

### 🛠️ Technical Features
- **Laravel 12**: Latest Laravel framework with PHP 8.2+
- **SQLite Database**: Lightweight, file-based database
- **API Ready**: RESTful API endpoints for all features
- **Rate Limiting**: Built-in protection against abuse
- **CSRF Protection**: Secure form handling
- **Caching**: Optimized performance with caching
- **OTP Management**: Secure OTP generation, delivery, and verification
- **SMS Integration**: Multiple SMS providers (Mock, Twilio, AWS)

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM (for frontend assets)

### Installation

#### Option 1: Automated Setup (Recommended)

**Windows:**
```bash
setup.bat
```

**Linux/Mac:**
```bash
chmod +x setup.sh
./setup.sh
```

#### Option 2: Manual Setup

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/laravel-12-multi-role-auth.git
cd laravel-12-multi-role-auth
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp ENV_CONFIGURATION.txt .env
php artisan key:generate
```

4. **Database setup**
```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

5. **Start the application**
```bash
php artisan serve
npm run dev
```

Visit `http://localhost:8000` to see your application!

## 🔧 Configuration

### Social Authentication Setup

1. **Google OAuth**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Create OAuth 2.0 credentials
   - Add redirect URI: `http://localhost:8000/auth/google/callback`

2. **Facebook OAuth**
   - Go to [Facebook Developers](https://developers.facebook.com/)
   - Create a new app
   - Add redirect URI: `http://localhost:8000/auth/facebook/callback`

3. **Update .env file**
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
```

For detailed setup instructions, see [SOCIAL_AUTH_SETUP.md](SOCIAL_AUTH_SETUP.md).

### OTP Authentication Setup

The application supports both Email OTP and SMS OTP authentication with enhanced user experience.

#### Email OTP Configuration

1. **Email Provider Setup**
   - Configure your email provider in `.env`
   - Supported providers: SMTP, Mailgun, SendGrid, etc.

2. **Update .env file**
```env
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### SMS OTP Configuration

1. **SMS Provider Setup**
   - Choose from Mock, Twilio, or AWS SNS
   - Configure provider-specific settings

2. **Update .env file**
```env
# For Twilio
SMS_PROVIDER=twilio
TWILIO_SID=your_twilio_sid
TWILIO_TOKEN=your_twilio_token
TWILIO_FROM=your_twilio_number

# For AWS SNS
SMS_PROVIDER=aws
AWS_ACCESS_KEY_ID=your_aws_key
AWS_SECRET_ACCESS_KEY=your_aws_secret
AWS_DEFAULT_REGION=your_aws_region
```

For detailed OTP setup instructions, see [OTP_AUTHENTICATION.md](OTP_AUTHENTICATION.md).

## �� Project Structure

```
laravel-12-multi-role-auth/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/SocialiteController.php    # Social auth controller
│   │   └── Api/                            # API controllers
│   ├── Models/
│   │   └── User.php                        # User model with roles
│   └── Livewire/                           # Livewire components
├── resources/views/
│   ├── livewire/auth/
│   │   ├── login.blade.php                 # Login form
│   │   ├── register.blade.php              # Register form
│   │   └── social-login.blade.php          # Social auth buttons
│   └── admin/                              # Admin dashboard views
├── database/
│   ├── migrations/                         # Database migrations
│   └── seeders/                            # Database seeders
├── routes/
│   ├── web.php                             # Web routes
│   └── api.php                             # API routes
└── config/
    └── services.php                        # Social auth config
```

## 🎯 User Roles & Permissions

### Available Roles
- **Admin**: Full system access
- **Staff**: Administrative access
- **User**: Basic user access
- **Customer**: Customer-specific features
- **Wholeseller**: Wholesale operations
- **Seller**: Sales operations

### Role-based Features
- **Dashboard Access**: Different dashboards per role
- **API Endpoints**: Role-specific API access
- **UI Components**: Role-based interface elements
- **Social Registration**: Role-specific signup options

## 🔌 API Endpoints

### Authentication
- `POST /api/login` - User login
- `POST /api/register` - User registration
- `POST /api/logout` - User logout

### Social Authentication
- `GET /auth/{provider}` - OAuth redirect
- `GET /auth/{provider}/callback` - OAuth callback
- `GET /auth/{provider}/{role}` - Role-specific OAuth

### User Management
- `GET /api/users` - List users
- `POST /api/users` - Create user
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

### Dashboard
- `GET /api/dashboard/stats` - Dashboard statistics
- `GET /api/dashboard/analytics` - Analytics data
- `GET /api/dashboard/activity` - Recent activity

## 🎨 Customization

### Styling
The application uses Tailwind CSS with custom components. You can customize:
- Colors in `tailwind.config.js`
- Components in `resources/views/components/`
- Layouts in `resources/views/layouts/`

### Social Authentication
Add more providers by:
1. Adding configuration to `config/services.php`
2. Updating the UI in `resources/views/livewire/auth/social-login.blade.php`
3. Adding environment variables to `.env`

### Roles & Permissions
Modify roles and permissions in:
- `database/seeders/RoleSeeder.php`
- `app/Http/Middleware/RoleMiddleware.php`

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --filter=Auth
php artisan test --filter=Social
```

## 🚀 Deployment

### Production Setup
1. Update `.env` with production settings
2. Set `APP_ENV=production`
3. Configure your database
4. Set up your OAuth providers with production URLs
5. Run `php artisan config:cache`
6. Run `php artisan route:cache`

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
FACEBOOK_REDIRECT_URI=https://yourdomain.com/auth/facebook/callback
```

## 📚 Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://laravel-livewire.com/)
- [Spatie Permission Documentation](https://spatie.be/docs/laravel-permission)
- [Social Authentication Setup](SOCIAL_AUTH_SETUP.md)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel Team](https://laravel.com/) for the amazing framework
- [Livewire Team](https://laravel-livewire.com/) for real-time components
- [Spatie](https://spatie.be/) for the permission package
- [Tailwind CSS](https://tailwindcss.com/) for the utility-first CSS framework

## 📞 Support

If you have any questions or need help:
- Create an issue on GitHub
- Check the documentation
- Review the setup guides

---

**Made with ❤️ using Laravel 12, Livewire 3, and Tailwind CSS** 