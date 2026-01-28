FROM php:8.2-fpm-bullseye

# Instalar dependencias necesarias para compilar extensiones
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev libxml2-dev pkg-config build-essential \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring xml zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
