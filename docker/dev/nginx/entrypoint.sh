#!/bin/bash
set -eu

usermod -u $UID_VAR www-data
groupmod -g 4444 dialout
groupmod -g 5555 staff
groupmod -g $GID_VAR www-data
chown -R www-data:www-data /var/www

sed -i "s#{{APP_HOSTNAME}}#${APP_HOSTNAME}#g" /etc/nginx/sites-enabled/app.conf

sleep 5 && nginx -g 'daemon off;'
