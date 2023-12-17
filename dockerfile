# Use the official PHP 8.1 image with FPM
FROM php:8.2-cli

RUN echo 'root:laravel' | chpasswd

# Create a non-root user
RUN useradd -ms /bin/bash laravel



# Install necessary packages
RUN apt-get update -y && \
    apt-get install -y openssl zip unzip git libpq-dev libonig-dev nano

# Install PHP extensions
RUN docker-php-ext-configure pdo_mysql && \
    docker-php-ext-install pdo pdo_mysql mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /petanque_assos_laravel

# Copy the application files
COPY . /petanque_assos_laravel

# Change ownership to non-root user
RUN chown -R laravel:laravel /petanque_assos_laravel

# Switch to non-root user
USER laravel

# Run Composer install and update
RUN composer install --verbose && \
    composer update --with-all-dependencies --ignore-platform-req=ext-fileinfo

RUN composer require laravel/breeze --dev

# Copy .env.example and rename it as .env
# Note: The permissions are set to 600 for security reasons
COPY --chown=laravel:laravel .env.example .env
RUN chmod 600 .env

# Generate Laravel application key
RUN php artisan key:generate 

# Change permissions of the storage and bootstrap/cache directories
RUN chmod -R 775 /petanque_assos_laravel/storage /petanque_assos_laravel/bootstrap/cache




# Command to run the Laravel application
CMD php artisan serve --host=0.0.0.0 --port=8000


# Expose port 8000
EXPOSE 8000
