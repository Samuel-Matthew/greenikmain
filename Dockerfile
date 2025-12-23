FROM richarvey/nginx-php-fpm:latest

# 1. Set working directory
WORKDIR /var/www/html

# 2. Install PostgreSQL dependencies using apk (Alpine Package Manager)
# We install the dev headers, then the PHP extension, then remove headers to keep image small
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

# 3. Copy project files
COPY . .

# 4. Environment variables for the Nginx image
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# 5. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 6. Ensure storage and bootstrap directories exist
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

# 7. Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Render default port
EXPOSE 10000

# 9. Start command
CMD php artisan migrate --force && php artisan storage:link && /start.sh