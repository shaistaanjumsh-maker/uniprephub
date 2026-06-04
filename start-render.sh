#!/bin/bash
set -eo pipefail

if [ ! -f .env ]; then
  cp .env.production .env
fi

php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
