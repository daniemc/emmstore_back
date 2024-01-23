#!/bin/sh

cd /var/www

composer update

php artisan storage:link

php artisan migrate

php artisan config:cache

php artisan route:cache

php artisan view:cache

/usr/bin/supervisord -c /etc/supervisord.conf
