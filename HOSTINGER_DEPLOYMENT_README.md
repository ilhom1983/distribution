# Hostinger Deployment Package - README

## 📁 Structure for Hostinger Upload

This package is configured for Hostinger's `public_html` structure:

```
ixasales.com/
├── public_html/          # Web root (upload to Hostinger)
│   ├── index.php         # Updated for Hostinger
│   ├── .htaccess         # Updated for Hostinger
│   ├── build/            # Built assets
│   ├── favicon.ico
│   └── robots.txt
├── app/                  # Laravel application
├── bootstrap/            # Laravel bootstrap
├── config/              # Laravel configuration
├── database/            # Migrations and seeders
├── lang/                # Language files
├── resources/           # Views, CSS, JS
├── routes/              # Route definitions
├── storage/             # File storage
├── vendor/              # Composer dependencies
├── artisan              # Laravel CLI
├── composer.json        # PHP dependencies
├── composer.lock        # Locked PHP dependencies
├── package.json         # Node.js dependencies
├── package-lock.json    # Locked Node.js dependencies
├── vite.config.js       # Vite configuration
├── .env                 # Environment configuration
├── .gitignore           # Git ignore rules
├── .editorconfig        # Editor configuration
├── .gitattributes       # Git attributes
├── deploy-hostinger.sh  # Hostinger deployment script
└── DEPLOYMENT_GUIDE.md  # Deployment guide
```

## 🚀 Upload Instructions

### Step 1: Upload to Hostinger
Upload the entire `ixasales.com` folder to your Hostinger server.

### Step 2: SSH and Deploy
```bash
ssh -p 65002 u421742373@37.44.245.189
cd domains/ixasales.com

# Run deployment script
chmod +x deploy-hostinger.sh
./deploy-hostinger.sh
```

### Step 3: Configure Environment
```bash
# Edit .env file
nano .env

# Set these values:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ixasales.com
DB_HOST=localhost
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Setup Database
```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## 🎯 Expected Result

After deployment, your application should work at:
- Admin: https://ixasales.com/admin
- Sales: https://ixasales.com/mobile/sales
- Warehouse: https://ixasales.com/mobile/warehouse
- Delivery: https://ixasales.com/mobile/delivery

## ⚠️ Important Notes

- The `public_html` folder contains the web root files
- Laravel files are in the parent directory
- `index.php` is configured to load Laravel from `../`
- `.htaccess` is configured for Laravel routing
- Build assets are included in `public_html/build/`

## 🔧 Troubleshooting

If you encounter issues:
1. Check file permissions: `chmod -R 755 storage bootstrap/cache`
2. Check logs: `tail -f storage/logs/laravel.log`
3. Clear caches: `php artisan config:clear`
4. Verify database connection in `.env` 