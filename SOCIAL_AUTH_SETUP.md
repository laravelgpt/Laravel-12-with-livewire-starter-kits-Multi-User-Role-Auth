# Social Authentication Setup Guide

This guide will help you set up social authentication providers for your Laravel 12 application with Livewire and multi-user role authentication.

## 🚀 Features Added

- **Google OAuth** - Sign in with Google
- **Facebook OAuth** - Sign in with Facebook
- **Role-based Registration** - Users can sign up with specific roles
- **Automatic Role Assignment** - New users get assigned appropriate roles
- **Email Verification** - Social users are automatically verified

## 📋 Prerequisites

1. Laravel 12 application with Livewire
2. Spatie Permission package installed
3. Database migrations run
4. OAuth applications created on provider platforms

## 🔧 Configuration

### 1. Environment Variables

Copy the content from `ENV_CONFIGURATION.txt` to your `.env` file, then update the provider credentials:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
```

### 2. Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Google+ API
4. Go to Credentials → Create Credentials → OAuth 2.0 Client ID
5. Set Application Type to "Web application"
6. Add authorized redirect URIs:
   - `http://localhost:8000/auth/google/callback` (for development)
   - `https://yourdomain.com/auth/google/callback` (for production)
7. Copy Client ID and Client Secret to your `.env` file

### 3. Facebook OAuth Setup

1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Create a new app
3. Add Facebook Login product
4. Configure OAuth redirect URIs:
   - `http://localhost:8000/auth/facebook/callback`
5. Copy App ID and App Secret to your `.env` file

## 🛣️ Routes Available

### Basic Social Authentication
- `GET /auth/{provider}` - Redirect to OAuth provider
- `GET /auth/{provider}/callback` - Handle OAuth callback

### Role-based Social Authentication
- `GET /auth/{provider}/{role}` - Redirect to OAuth provider with specific role
- `GET /auth/{provider}/{role}/callback` - Handle OAuth callback with role assignment

### Available Providers
- `google` - Google OAuth
- `facebook` - Facebook OAuth

### Available Roles
- `admin` - Administrator
- `staff` - Staff member
- `user` - Regular user
- `customer` - Customer (default)
- `wholeseller` - Wholeseller
- `seller` - Seller

## 🎨 UI Components

### Social Login Buttons
The social authentication buttons are included in:
- Login form (`/login`)
- Register form (`/register`) - with role selection options

### Available Providers in UI
- **Google** - White button with Google logo
- **Facebook** - Blue button with Facebook logo

### Customization
You can customize the social login component by editing:
- `resources/views/livewire/auth/social-login.blade.php`

## 🔐 Security Features

1. **Rate Limiting** - Built-in Laravel rate limiting
2. **CSRF Protection** - All forms protected
3. **Secure Redirects** - Validated callback URLs
4. **Role-based Access** - Users assigned appropriate roles
5. **Email Verification** - Social users automatically verified

## 🧪 Testing

### Test Social Authentication
1. Start your Laravel application: `php artisan serve`
2. Visit `/login` or `/register`
3. Click on social authentication buttons
4. Complete OAuth flow
5. Verify user is created and logged in with correct role

### Test Role-based Registration
1. Visit `/register`
2. Use role-specific social authentication links
3. Verify user gets assigned the intended role

## 🚨 Troubleshooting

### Common Issues

1. **"Invalid redirect URI"**
   - Check your OAuth app configuration
   - Ensure redirect URI matches exactly

2. **"Client ID not found"**
   - Verify environment variables are set correctly
   - Clear config cache: `php artisan config:clear`

3. **"User not created"**
   - Check database connection
   - Verify migrations are run: `php artisan migrate`

4. **"Role not assigned"**
   - Ensure roles exist in database
   - Run seeders: `php artisan db:seed --class=RoleSeeder`

### Debug Commands

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Check routes
php artisan route:list | grep auth

# Check database
php artisan tinker
>>> App\Models\User::with('roles')->get()
```

## 📚 Additional Resources

- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Spatie Permission Documentation](https://spatie.be/docs/laravel-permission)
- [Laravel Livewire Documentation](https://laravel-livewire.com/)
- [Google OAuth Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Facebook Login Documentation](https://developers.facebook.com/docs/facebook-login/)

## 🤝 Contributing

To add more social providers:
1. Add provider configuration to `config/services.php`
2. Add environment variables to `.env`
3. Update the social login component UI
4. Test the integration

## 📄 License

This social authentication system is part of your Laravel 12 application and follows the same license terms. 