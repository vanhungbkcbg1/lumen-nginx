#!/bin/sh
# this command is used to run migrate and start php-fpm
#wait for database container is up
./wait-for-it.sh mysql:3306 -t 30
php /var/www/html/artisan migrate

php-fpm -F -R
