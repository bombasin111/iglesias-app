# Usamos imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalamos extensiones necesarias (si usas MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiamos los archivos de tu app al contenedor
COPY . /var/www/html/

# Habilitamos mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Puerto expuesto
EXPOSE 80