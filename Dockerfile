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

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY --from=deps /app/vendor /var/www/html/vendor

COPY ./src /var/www/html
RUN mkdir -p /var/www/html/tmp && chown -R www-data:www-data /var/www/html/tmp && chmod -R 777 /var/www/html/tmp
RUN mkdir -p /var/www/html/public/assets /var/www/html/public/assets/css /var/www/html/public/assets/js \
    && chown -R www-data:www-data /var/www/html/public/assets \
    && chmod -R 755 /var/www/html/public/assets

USER www-data

