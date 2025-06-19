@echo off
REM Laravel 12 Multi-Role Auth Setup Script for Windows
echo 🚀 Setting up Laravel 12 Multi-Role Auth with Google & Facebook OAuth...

REM Check if .env file exists
if not exist .env (
    echo 📝 Creating .env file from ENV_CONFIGURATION.txt...
    copy ENV_CONFIGURATION.txt .env
    echo ✅ .env file created!
) else (
    echo ℹ️  .env file already exists
)

REM Generate application key
echo 🔑 Generating application key...
php artisan key:generate

REM Create SQLite database
echo 🗄️  Creating SQLite database...
if not exist database\database.sqlite (
    type nul > database\database.sqlite
)

REM Run migrations
echo 📊 Running database migrations...
php artisan migrate

REM Seed the database
echo 🌱 Seeding database with roles and users...
php artisan db:seed

REM Clear all caches
echo 🧹 Clearing application caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

REM Install npm dependencies (if package.json exists)
if exist package.json (
    echo 📦 Installing npm dependencies...
    npm install
)

echo.
echo 🎉 Setup completed successfully!
echo.
echo 📋 Next steps:
echo 1. Configure Google OAuth in .env
echo 2. Configure Facebook OAuth in .env
echo 3. Start the development server: php artisan serve
echo 4. Visit http://localhost:8000 to test your application
echo.
echo 📚 For detailed setup instructions, see SOCIAL_AUTH_SETUP.md
echo.
pause 