#!/bin/sh

mkdir -p storage/framework/sessions
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/logs

touch storage/logs/laravel.log

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

php artisan optimize:clear

php artisan config:cache

php artisan migrate --force

exec apache2-foreground
