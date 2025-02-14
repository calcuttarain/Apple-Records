FROM php:8.2-cli AS deps
WORKDIR /app

RUN apt-get update && apt-get install -y \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --no-interaction --prefer-dist

FROM php:8.2-apache AS final

RUN apt-get update && apt-get install -y \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Configurări PHP și Apache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite

COPY --from=deps /app/vendor /var/www/html/vendor

COPY ./src /var/www/html
RUN mkdir -p /var/www/html/tmp && chown -R www-data:www-data /var/www/html/tmp && chmod -R 777 /var/www/html/tmp

USER www-data

