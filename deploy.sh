#!/bin/bash

# Laravel Distribution App - Production Deployment Script
# Run this script on your production server

echo "🚀 Starting Laravel Distribution App Deployment..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel project root."
    exit 1
fi

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "📦 Installing Node.js dependencies..."
npm install

echo "🔨 Building frontend assets..."
npm run build

echo "🔐 Setting proper permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || echo "⚠️  Could not set ownership (may need sudo)"

echo "🗑️  Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Configure your .env file with production settings"
echo "2. Run: php artisan key:generate"
echo "3. Run: php artisan migrate"
echo "4. Set APP_DEBUG=false in .env"
echo "5. Configure your web server (Apache/Nginx)"
echo ""
echo "🔍 Check deployment guide: DEPLOYMENT_GUIDE.md" 