FROM php:8.2-apache

# Install ekstensi mysqli
RUN docker-php-ext-install mysqli

# Salin semua file ke dalam container
COPY . /var/www/html

# Aktifkan mod_rewrite jika perlu
RUN a2enmod rewrite
