FROM php:8.3.13-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    git \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libonig-dev \
    libpng-dev \
    libssl-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    pkg-config \
    unzip \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) exif gd intl mbstring opcache pdo_mysql zip \
    && pecl install mongodb-1.21.0 \
    && docker-php-ext-enable mongodb \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN sed -i 's|/var/www/html|/var/www/html/Public|g' /etc/apache2/sites-available/000-default.conf \
    && echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN --mount=type=cache,target=/tmp/cache composer update --no-dev --optimize-autoloader

COPY . .

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]