FROM composer:lts as deps

WORKDIR /app

COPY composer.json composer.lock /app/

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stadiul 2: Imagine PHP cu Apache
FROM php:8.2-apache as final

RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=deps /app/vendor /var/www/html/vendor
