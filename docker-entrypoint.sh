#!/bin/bash
set -e

PORT_VAL=${PORT:-8080}
# Ensure Apache listens on $PORT
sed -i "s/80/${PORT_VAL}/g" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT_VAL}>/g" /etc/apache2/sites-available/000-default.conf

# Prepare data dir and sqlite database
mkdir -p /var/data
if [ ! -f "$DB_DATABASE" ]; then
  touch "$DB_DATABASE"
fi

# Run migrations (ignore failure if schema already exists)
php artisan migrate --force || true

exec "$@"
