FROM php:8.2-fpm-bookworm

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring xml zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
