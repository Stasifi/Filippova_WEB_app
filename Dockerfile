FROM php:8.1-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite

COPY app/ .

# Создание БД и таблицы (правильное форматирование)
RUN touch /var/www/html/database.db && \
    sqlite3 /var/www/html/database.db "CREATE TABLE IF NOT EXISTS users ( \
        id INTEGER PRIMARY KEY AUTOINCREMENT, \
        username TEXT NOT NULL UNIQUE, \
        password TEXT NOT NULL, \
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP \
    );" && \
    chown -R www-data:www-data /var/www/html && \
    chmod 666 /var/www/html/database.db

EXPOSE 80