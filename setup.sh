#!/bin/bash

# Laravel 12 Multi-Role Auth Setup Script
echo "🚀 Setting up Laravel 12 Multi-Role Auth with Google & Facebook OAuth..."

# Check if .env file exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file from ENV_CONFIGURATION.txt..."
    cp ENV_CONFIGURATION.txt .env
    echo "✅ .env file created!"
else
    echo "ℹ️  .env file already exists"
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Create SQLite database
echo "🗄️  Creating SQLite database..."
touch database/database.sqlite

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate

# Seed the database
echo "🌱 Seeding database with roles and users..."
php artisan db:seed

# Clear all caches
echo "🧹 Clearing application caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Install npm dependencies (if package.json exists)
if [ -f package.json ]; then
    echo "📦 Installing npm dependencies..."
    npm install
fi

echo ""
echo "🎉 Setup completed successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Configure Google OAuth in .env"
echo "2. Configure Facebook OAuth in .env"
echo "3. Start the development server: php artisan serve"
echo "4. Visit http://localhost:8000 to test your application"
echo ""
echo "📚 For detailed setup instructions, see SOCIAL_AUTH_SETUP.md"
echo "" 