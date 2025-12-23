FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache


# Expose port
EXPOSE 10000

# Start Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000

