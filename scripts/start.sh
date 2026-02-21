#!/usr/bin/env bash
set -e

echo "Caching config..."
php /var/www/html/artisan config:cache

echo "Caching routes..."
php /var/www/html/artisan route:cache

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx..."
exec nginx -g 'daemon off;'
