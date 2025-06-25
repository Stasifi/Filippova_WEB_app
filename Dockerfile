FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite

COPY app/ .

RUN chown -R www-data:www-data /var/www/html \
    && touch /var/www/html/database.db \
    && chmod 666 /var/www/html/database.db

EXPOSE 80