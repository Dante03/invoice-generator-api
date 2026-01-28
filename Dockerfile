FROM php:8.3-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# ===============================
# System dependencies
# ===============================
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
    libsodium-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg

# ===============================
# PHP extensions (VALIDAS)
# ===============================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    intl \
    gd \
    sodium

# ===============================
# Apache
# ===============================
RUN a2enmod rewrite

# ===============================
# Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# App
# ===============================
WORKDIR /var/www/html

COPY . .

# ===============================
# Composer install
# ===============================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress

# ===============================
# Permissions
# ===============================
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# ===============================
# Apache vhost
# ===============================
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
