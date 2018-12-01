#!/bin/sh
REFRESH_TOKEN=${REFRESH_TOKEN:-"0 * * * *"}
REFRESH_CACHE=${REFRESH_CACHE:-"*/10 * * * *"}
chown -R www-data:www-data /var/www/html/cache
chown -R www-data:www-data /var/www/html/config
rm -rf /tmp/cron.`whoami`
echo "${REFRESH_TOKEN} php /var/www/html/one.php token:refresh" >> /tmp/cron.`whoami`
echo "${REFRESH_CACHE} php /var/www/html/one.php cache:refresh" >> /tmp/cron.`whoami`
crontab -u `whoami` /tmp/cron.`whoami`
crond
php-fpm & nginx '-g daemon off;'