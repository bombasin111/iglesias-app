FROM php:8.2-apache

# Instalar extensiones para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar código al contenedor
COPY . /var/www/html/

# Permisos y mod_rewrite
RUN chmod -R 755 /var/www/html
RUN a2enmod rewrite

EXPOSE 80