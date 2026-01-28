# ===============================
# Laravel 12 – Dockerfile Render
# ===============================

FROM php:8.3-apache

# Permitir composer como root
ENV COMPOSER_ALLOW_SUPERUSER=1

# -------------------------------
# Dependencias del sistema
# -------------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    intl \
    gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# -------------------------------
# Apache
# -------------------------------
RUN a2enmod rewrite

# -------------------------------
# Composer
# -------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------------
# App
# -------------------------------
WORKDIR /var/www/html

COPY . .

# -------------------------------
# Instalar dependencias Laravel
# -------------------------------
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# -------------------------------
# Permisos
# -------------------------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# -------------------------------
# Apache vhost (Laravel public)
# -------------------------------
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# -------------------------------
# Exponer puerto
# -------------------------------
EXPOSE 80

# -------------------------------
# Start
# -------------------------------
CMD ["apache2-foreground"]
