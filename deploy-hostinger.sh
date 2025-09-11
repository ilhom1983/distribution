#!/bin/bash

# Laravel Distribution App - Hostinger Deployment Script
# Run this script on your Hostinger server

echo "🚀 Starting Laravel Distribution App Deployment for Hostinger..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel project root."
    exit 1
fi

echo "📦 Installing PHP dependencies with Composer 2..."
composer2 install --no-dev --optimize-autoloader

echo "🔍 Checking Node.js availability..."
if command -v npm &> /dev/null; then
    echo "✅ Node.js found, installing dependencies..."
    npm install --production
    
    echo "🔨 Building frontend assets..."
    npm run build
else
    echo "⚠️  Node.js not found. You'll need to build assets manually or contact Hostinger support."
    echo "📋 Manual build steps:"
    echo "1. Install Node.js on your Hostinger server"
    echo "2. Run: npm install"
    echo "3. Run: npm run build"
fi

echo "🔐 Setting proper permissions..."
chmod -R 755 storage bootstrap/cache

echo "🗑️  Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Configure your .env file with production settings"
echo "2. Run: php artisan key:generate"
echo "3. Run: php artisan migrate"
echo "4. Set APP_DEBUG=false in .env"
echo ""
echo "🔍 If you see route caching errors, run: php artisan route:clear"
echo "🔍 Check deployment guide: DEPLOYMENT_GUIDE.md" 