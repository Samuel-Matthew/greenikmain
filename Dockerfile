# Use a version that includes a web server helper or stick to PHP FPM
FROM richarvey/nginx-php-fpm:latest

# 1. Set the working directory to the standard web path
WORKDIR /var/www/html

# 2. Install system dependencies for PostgreSQL (needed for e-commerce)
RUN apt-get update && apt-get install -y libpq-dev

# 3. Copy project files
COPY . .

# 4. Set environment variables for Render
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# 5. Install dependencies
RUN composer install --no-dev --optimize-autoloader

# 6. Ensure storage directories exist (prevents the chown error)
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    bootstrap/cache

# 7. Fix permissions using the correct relative paths
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Render uses port 10000 by default, but this image handles it via Nginx
EXPOSE 10000

# 9. Start-up: Run migrations and start the server
# Note: In production, we use a script or combined command
CMD php artisan migrate --force && /start.sh