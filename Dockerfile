FROM php:8.2-cli-bullseye

# Instalar dependencias necesarias para extensiones
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring xml zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /app

# Copiar proyecto
COPY . .

# Instalar dependencias de Laravel y cachear config
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Exponer puerto
EXPOSE 8080

# Comando de inicio
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
