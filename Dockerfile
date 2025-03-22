# Utiliser une image PHP avec Apache
FROM php:8.3.13-apache

# Mise à jour du système et installation des extensions nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev libonig-dev \
    libxml2-dev libicu-dev libxslt-dev libzip-dev pkg-config libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring intl gd opcache exif zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer et activer l'extension MongoDB PHP (version 1.21.0)
RUN pecl install mongodb-1.21.0 && docker-php-ext-enable mongodb

# Activer le module mod_rewrite d'Apache
RUN a2enmod rewrite

# Configurer Apache pour pointer vers le dossier public
RUN sed -i 's|/var/www/html|/var/www/html/Public|g' /etc/apache2/sites-available/000-default.conf

# Définir les fichiers par défaut recherchés par Apache
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Copier Composer à partir de l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers nécessaires pour composer
COPY composer.json composer.lock ./

# Mettre à jour Composer et installer les dépendances avec les bonnes versions
RUN composer update --no-dev --optimize-autoloader

# Copier le reste de l'application
COPY . .

# Changer les permissions des fichiers pour Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache en premier plan
CMD ["apache2-foreground"]