#!/bin/sh

npm run dev >> /var/www/restomenu/tail.txt
php artisan serve >> /var/www/restomenu/tail.txt

cd /var/www/thousands-dev/
docker-compose up dbvince phpmyadmin >> /var/www/restomenu/tail.txt

tail -f >> /var/www/restomenu/tail.txt