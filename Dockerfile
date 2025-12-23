FROM richarvey/nginx-php-fpm:latest

# 1. Install system dependencies (Alpine syntax)
RUN apk add --no-cache postgresql-dev nodejs npm

WORKDIR /var/www/html
COPY . .

# 2. Environment variables
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# 3. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 4. Install NPM dependencies and BUILD your frontend (Vite)
RUN npm install
RUN npm run build

# 5. Ensure storage directories exist
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

# 6. Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 10000

# 7. Final Start Command
CMD php artisan migrate --force && php artisan storage:link && /start.sh