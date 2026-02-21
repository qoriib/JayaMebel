#!/usr/bin/env bash
set -e

echo "Caching config..."
php /var/www/html/artisan config:cache

echo "Caching routes..."
php /var/www/html/artisan route:cache

echo "Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/laravel.conf
