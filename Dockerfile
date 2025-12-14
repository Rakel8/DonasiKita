# Build vendors
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock .
RUN composer install --no-dev --optimize-autoloader --prefer-dist
COPY . .
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Runtime image
FROM php:8.2-apache

# Install extensions needed by Laravel and SQLite
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       libzip-dev unzip \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Copy app
COPY --from=vendor /app /var/www/html
WORKDIR /var/www/html

# Configure Apache to serve from public/
RUN sed -i 's@/var/www/html@/var/www/html/public@g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Entrypoint sets port and prepares database
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENV APP_ENV=production \
    APP_DEBUG=false \
    PORT=8080 \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/var/data/database.sqlite

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
EXPOSE 8080
