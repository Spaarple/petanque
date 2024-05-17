# Use the official PHP 8.2 image with CLI
FROM php:8.2-cli

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update \
    && apt-get install -y --no-install-recommends nodejs gnupg wget locales apt-utils git g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev libicu-dev chromium \
    && apt-get update \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \

RUN apt-get update
RUN apt-get install -y --no-install-recommends locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/cache/apt/archives/*

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo pdo_mysql gd opcache intl calendar dom mbstring zip gd xsl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/installer \
    && ln -s /root/.composer/vendor/laravel/installer/laravel /usr/local/bin/laravel

WORKDIR /var/www/

# Copy the application files
COPY . /var/www

# Install PHP dependencies
RUN composer install

# Change ownership to non-root user
RUN chown -R 1000:1000 /var/www

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
