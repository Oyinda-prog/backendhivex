#!/bin/sh

mkdir -p storage/framework/sessions
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views

chmod -R 775 storage bootstrap/cache

php artisan optimize:clear

php artisan migrate --force

exec apache2-foreground
