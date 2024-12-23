FROM php:8.1-apache

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/symfony

# Copier les fichiers de l'application
COPY . /var/www/symfony

# Changer les permissions
RUN chown -R www-data:www-data /var/www/symfony

# Exposer le port 80
