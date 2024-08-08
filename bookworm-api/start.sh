#!/bin/bash
set -e

# Bail out if the vendor folder is not empty
if [ "$(ls -A /var/www/html/vendor)" ]; then
    echo "Vendor folder is not empty, skipping composer install"
    exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
else
    # Install/update dependencies
    echo "Running composer install"
    composer install

    # Run any necessary Laravel commands
    echo "Running migrations"
    php artisan migrate --force

    echo "Running seeds"
    php artisan db:seed

    # Start supervisord
    echo "Starting supervisord"
    exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
fi
