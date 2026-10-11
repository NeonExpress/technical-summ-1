FROM php:8.2-apache

# CodeIgniter requires intl and mbstring. SQLite stores the deployed demo data.
RUN apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev libonig-dev libsqlite3-dev unzip \
    && docker-php-ext-install intl mbstring mysqli sqlite3 \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install \
        --no-dev \
        --no-interaction \
        --no-progress \
        --prefer-dist \
        --optimize-autoloader \
    && chown -R www-data:www-data writable \
    && chmod -R 775 writable

# Serve CodeIgniter's public directory and allow its rewrite rules.
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && sed -ri 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -ri 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-available/000-default.conf

ENV CI_ENVIRONMENT=production \
    DB_DRIVER=SQLite3

EXPOSE 10000

CMD ["apache2-foreground"]
