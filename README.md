# Laravel 12 Authentication System

A modern, feature-rich authentication system built with Laravel 12, Livewire 3, and Volt. This project provides a complete authentication solution with role-based access control, user management, and a beautiful responsive UI.

**Version**: 1.0  
**Repository**: [https://github.com/laravelgpt/Laravel-12-with-livewire-starter-kits-Multi-User-Role-Auth](https://github.com/laravelgpt/Laravel-12-with-livewire-starter-kits-Multi-User-Role-Auth)

![Laravel 12](https://img.shields.io/badge/Laravel-12.x-red.svg)
![Livewire](https://img.shields.io/badge/Livewire-3.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.x-38B2AC.svg)
![Version](https://img.shields.io/badge/Version-1.0-green.svg)

## 🚀 Features

### 🔐 Authentication & Authorization
- **User Registration & Login**: Complete authentication flow with email verification
- **Password Reset**: Secure password reset functionality with email tokens
- **Email Verification**: Built-in email verification system
- **Role-Based Access Control**: Advanced RBAC using Spatie Laravel Permission
- **Session Management**: Secure session handling with remember me functionality
- **Password Confirmation**: Additional security layer for sensitive actions

### 👥 User Management
- **Multi-Role System**: Support for admin, staff, user, customer, wholeseller, seller roles
- **User Profiles**: Complete user profile management
- **Role Assignment**: Dynamic role assignment and management
- **Permission System**: Granular permission control
- **User Statistics**: Comprehensive user analytics and reporting

### 🎨 User Interface
- **Modern Design**: Beautiful, responsive UI built with Tailwind CSS 4
- **Dark Mode Support**: Automatic dark mode detection and switching
- **Mobile Responsive**: Optimized for all device sizes
- **Livewire Components**: Interactive UI components with real-time updates
- **Volt Integration**: Modern component architecture

### 🛡️ Security Features
- **CSRF Protection**: Built-in CSRF token protection
- **Rate Limiting**: API and form submission rate limiting
- **Input Validation**: Comprehensive form validation
- **SQL Injection Protection**: Eloquent ORM protection
- **XSS Protection**: Automatic output escaping
- **Secure Headers**: Security headers implementation

### 📊 Dashboard & Analytics
- **Admin Dashboard**: Comprehensive admin interface with statistics
- **User Dashboard**: Personalized user dashboard
- **Analytics**: User growth, role distribution, and verification rate tracking
- **Reports**: Detailed system reports and insights
- **Real-time Updates**: Live data updates using Livewire

### 🔧 Settings & Configuration
- **Profile Settings**: User profile management
- **Password Management**: Secure password change functionality
- **Appearance Settings**: UI customization options
- **Account Deletion**: Secure account deletion with confirmation
- **System Settings**: Admin-level system configuration

### 🚨 Error Handling
- **Custom Error Pages**: Beautiful error pages for 403, 404, 419, 429, 500
- **Error Component**: Reusable error page component
- **Graceful Degradation**: Proper error handling throughout the application
- **User-Friendly Messages**: Clear error messages and guidance

### 🧪 Testing
- **Comprehensive Test Suite**: Full test coverage with Pest PHP
- **Authentication Tests**: Login, registration, password reset tests
- **Feature Tests**: Dashboard and settings functionality tests
- **Unit Tests**: Individual component testing

## 📋 Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18 or higher (for frontend assets)
- **Database**: MySQL, PostgreSQL, or SQLite
- **Web Server**: Apache, Nginx, or Laravel Sail

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/laravelgpt/Laravel-12-with-livewire-starter-kits-Multi-User-Role-Auth.git
cd Laravel-12-with-livewire-starter-kits-Multi-User-Role-Auth
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
```bash
# Configure your database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed the database with initial data
php artisan db:seed
```

### 5. Build Assets
```bash
# Build for development
npm run dev

# Build for production
npm run build
```

### 6. Start the Application
```bash
# Using Laravel's built-in server
php artisan serve

# Or using the development script (includes queue and Vite)
composer run dev
```

## 🏗️ Project Structure

```
laravel-12-auth/
├── app/
│   ├── Actions/              # Action classes
│   │   ├── Http/
│   │   │   ├── Controllers/      # Application controllers
│   │   │   │   ├── Api/         # API controllers
│   │   │   │   └── Auth/        # Authentication controllers
│   │   │   └── Middleware/      # Custom middleware
│   │   ├── Livewire/            # Livewire components
│   │   ├── Models/              # Eloquent models
│   │   └── Providers/           # Service providers
│   ├── config/                  # Configuration files
│   ├── database/
│   │   ├── factories/           # Model factories
│   │   ├── migrations/          # Database migrations
│   │   └── seeders/            # Database seeders
│   ├── public/                  # Public assets
│   ├── resources/
│   │   ├── css/                # Stylesheets
│   │   ├── js/                 # JavaScript files
│   │   └── views/              # Blade templates
│   │       ├── components/     # Blade components
│   │       ├── errors/         # Error pages
│   │       ├── livewire/       # Livewire views
│   │       └── layouts/        # Layout templates
│   ├── routes/                 # Route definitions
│   ├── storage/                # File storage
│   └── tests/                  # Test files
```

## 🔐 Authentication Flow

### Registration Process
1. User fills out registration form
2. Email verification sent automatically
3. User verifies email address
4. Account activated and user logged in

### Login Process
1. User enters credentials
2. System validates credentials
3. Session created with remember me option
4. User redirected to appropriate dashboard

### Password Reset
1. User requests password reset
2. Reset token sent via email
3. User clicks link and sets new password
4. Password updated and user logged in

## 👥 Role System

### Available Roles
- **Admin**: Full system access and user management
- **Staff**: Administrative access with limited permissions
- **User**: Standard user access
- **Customer**: Customer-specific features
- **Wholeseller**: Wholesale customer features
- **Seller**: Seller-specific features

### Role Assignment
```php
// Assign role to user
$user->assignRole('admin');

// Check user role
if ($user->hasRole('admin')) {
    // Admin specific logic
}

// Get user permissions
$permissions = $user->getAllPermissions();
```

## 🎨 UI Components

### Error Pages
The application includes custom error pages for common HTTP status codes:
- **403**: Access Forbidden
- **404**: Page Not Found
- **419**: Page Expired (CSRF token)
- **429**: Too Many Requests
- **500**: Internal Server Error

### Reusable Components
- **Error Page Component**: `<x-error-page>` for consistent error handling
- **Layout Components**: Responsive layout templates
- **Form Components**: Styled form elements
- **Navigation Components**: Header and sidebar navigation

## 🧪 Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/Auth/AuthenticationTest.php

# Run tests with coverage
php artisan test --coverage
```

### Test Structure
- **Feature Tests**: End-to-end functionality testing
- **Unit Tests**: Individual component testing
- **Authentication Tests**: Login, registration, password reset
- **Dashboard Tests**: Dashboard functionality
- **Settings Tests**: User settings and profile management

## 🔧 Configuration

### Environment Variables
```env
# Application
APP_NAME="Laravel Auth"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth
DB_USERNAME=root
DB_PASSWORD=

# Mail
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Queue
QUEUE_CONNECTION=sync
```

### Permission Configuration
The application uses Spatie Laravel Permission package for role management. Configure roles and permissions in the database seeders.

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` for security
3. Configure production database
4. Set up proper mail configuration
5. Configure web server (Apache/Nginx)
6. Set up SSL certificate
7. Configure caching and optimization

### Optimization Commands
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 📚 API Documentation

### Authentication Endpoints
- `POST /api/login` - User login
- `POST /api/register` - User registration
- `POST /api/logout` - User logout
- `POST /api/forgot-password` - Password reset request
- `POST /api/reset-password` - Password reset

### User Management Endpoints
- `GET /api/user` - Get current user
- `PUT /api/user` - Update user profile
- `GET /api/users` - List users (admin only)
- `GET /api/user/stats` - User statistics

## 🔄 Version History

### v1.0 (Current Release)
- **Initial Release**: Complete Laravel 12 authentication system
- **Multi-Role Support**: Admin, staff, user, customer, wholeseller, seller roles
- **Livewire 3 Integration**: Modern reactive components
- **Tailwind CSS 4**: Latest styling framework
- **Comprehensive Testing**: Full test coverage with Pest PHP
- **Error Handling**: Custom error pages and components
- **Security Features**: CSRF protection, rate limiting, input validation
- **Dashboard System**: Admin and user dashboards with analytics
- **Settings Management**: Profile, password, and appearance settings

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Laravel Documentation](https://laravel.com/docs)
2. Review the [Livewire Documentation](https://livewire.laravel.com/docs)
3. Search existing issues in the repository
4. Create a new issue with detailed information

## 🙏 Acknowledgments

- [Laravel Team](https://laravel.com) for the amazing framework
- [Livewire Team](https://livewire.laravel.com) for the reactive components
- [Spatie](https://spatie.be) for the permission package
- [Tailwind CSS](https://tailwindcss.com) for the utility-first CSS framework

---

**Built with ❤️ using Laravel 12, Livewire 3, and Tailwind CSS**

**Version 1.0** - [Download Latest Release](https://github.com/laravelgpt/Laravel-12-with-livewire-starter-kits-Multi-User-Role-Auth/releases/tag/v1.0) 