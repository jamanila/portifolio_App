#!/bin/sh
set -e

# Render (and most PaaS hosts) assign the listen port dynamically via $PORT.
# Apache's default config hardcodes port 80, so rewrite it at container
# startup — the actual value isn't known until the container runs.
PORT="${PORT:-80}"
sed -ri "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -ri "s/:80>/:${PORT}>/g" /etc/apache2/sites-available/*.conf

cd /var/www/html

if [ ! -L public/storage ]; then
    php artisan storage:link --force
fi

php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec apache2-foreground
