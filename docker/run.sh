#!/bin/sh

cd /var/www

composer update

php artisan storage:link

# php artisan migrate
php artisan migrate:refresh
php artisan db:seed

php artisan config:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache

/usr/bin/supervisord -c /etc/supervisord.conf
