FROM php:8.1-apache

WORKDIR /var/www/html

# Установка SQLite и зависимостей
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite

# Копируем файлы приложения
COPY app/ .

# Создаем БД и настраиваем права
RUN touch /var/www/html/database.db \
    && chown -R www-data:www-data /var/www/html \
    && chmod 666 /var/www/html/database.db

EXPOSE 80