# Laravel Distribution App - Production Deployment Guide

## 🚀 Pre-Deployment Checklist

### ✅ Files Removed for Production:
- `tests/` directory (all test files)
- `phpunit.xml` (testing configuration)
- `temp_*.php` files (temporary development files)
- `*.zip` files (backup files)
- `*.sql` files (database dumps)
- `*.md` documentation files
- `storage/logs/laravel.log` (large log file)
- `storage/debugbar/*` (debug files)

### 📁 Project Structure (Production Ready):
```
distribution-app/
├── app/                    # Application logic
├── bootstrap/             # Framework bootstrap
├── config/                # Configuration files
├── database/              # Migrations & seeders
├── lang/                  # Language files
├── public/                # Public assets
├── resources/             # Views, CSS, JS
├── routes/                # Route definitions
├── storage/               # File storage
├── vendor/                # Composer dependencies
├── .gitignore             # Git ignore rules
├── artisan                # Artisan CLI
├── composer.json          # PHP dependencies
├── package.json           # Node.js dependencies
└── vite.config.js         # Vite configuration
```

## 🛠️ Server Deployment Steps

### 1. Upload Files to Server
```bash
# Upload all files except:
# - node_modules/ (will be installed on server)
# - vendor/ (will be installed on server)
# - .env (will be created on server)
# - storage/logs/* (will be created on server)
```

### 2. Server Setup Commands
```bash
# Navigate to project directory
cd /path/to/your/project

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Create .env file (copy from .env.example)
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
# DB_HOST=localhost
# DB_DATABASE=your_database_name
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run database migrations
php artisan migrate

# Seed database (if needed)
php artisan db:seed

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Environment Configuration (.env)
```env
APP_NAME="Distribution App"
APP_ENV=production
APP_KEY=base64:your_generated_key
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 4. Web Server Configuration

#### Apache (.htaccess already included)
The project includes proper `.htaccess` files for Apache.

#### Nginx Configuration
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔧 Post-Deployment Verification

### 1. Check Application Status
```bash
# Check if application is working
curl -I https://your-domain.com

# Check Laravel status
php artisan about
```

### 2. Monitor Logs
```bash
# Check error logs
tail -f storage/logs/laravel.log

# Check web server logs
tail -f /var/log/nginx/error.log
```

### 3. Performance Optimization
```bash
# Enable OPcache (in php.ini)
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

## 🚨 Security Checklist

- [ ] `APP_DEBUG=false` in .env
- [ ] `APP_ENV=production` in .env
- [ ] Proper file permissions set
- [ ] Database credentials secured
- [ ] SSL certificate installed
- [ ] Firewall configured
- [ ] Regular backups scheduled

## 📊 Monitoring

### Recommended Monitoring Tools:
- Laravel Telescope (for debugging)
- Laravel Horizon (for queues)
- Server monitoring (CPU, RAM, Disk)
- Database monitoring
- Error tracking (Sentry, Bugsnag)

## 🔄 Maintenance Mode

```bash
# Enable maintenance mode
php artisan down

# Disable maintenance mode
php artisan up

# With custom message
php artisan down --message="Upgrading Database" --retry=60
```

## 📝 Notes

- The application uses Vite for frontend asset compilation
- Tailwind CSS is included for styling
- Alpine.js is used for interactive components
- Multi-tenancy is implemented with tenant isolation
- Role-based access control is in place
- Mobile-responsive design for delivery users 