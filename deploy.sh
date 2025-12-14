#!/bin/bash

# Exit on error
set -e

echo "Starting deployment..."

# Install composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Copy .env if not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Create SQLite database if not exists
touch database/database.sqlite

# Run Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

echo "Deployment completed!"
