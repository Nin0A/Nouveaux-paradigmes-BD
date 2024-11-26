# Utilisation de l'image PHP de base avec Apache
FROM php:8.0-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer les modules Apache pour PHP
RUN a2enmod rewrite

# Copier les fichiers PHP dans le conteneur
COPY ./src /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port 80
EXPOSE 80
