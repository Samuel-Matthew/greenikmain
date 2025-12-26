# FROM richarvey/nginx-php-fpm:latest

# # 1. Install system dependencies
# # We use 'nodejs-current' to get the latest version (Node 22+) in Alpine
# RUN apk add --no-cache postgresql-dev nodejs-current npm

# WORKDIR /var/www/html
# COPY . .

# # 2. Environment variables
# ENV WEBROOT /var/www/html/public
# ENV APP_ENV production

# # 3. Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader

# # 4. Install NPM dependencies and BUILD your frontend (Vite)
# RUN npm install
# RUN npm run build

# # 5. Ensure storage directories exist
# RUN mkdir -p storage/framework/sessions \
#     storage/framework/views \
#     storage/framework/cache \
#     storage/logs \
#     bootstrap/cache

# # 6. Fix permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
#     && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# EXPOSE 80


# # 7. Final Start Command
# CMD /start.sh



FROM richarvey/nginx-php-fpm:latest

# 1. Install system dependencies (MySQL, Node, NPM)
RUN apk add --no-cache \
    mysql-client \
    mysql-dev \
    nodejs-current \
    npm

# Enable MySQL PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
COPY . .

# 2. Environment variables
ENV WEBROOT=/var/www/html/public
ENV APP_ENV=production

# 3. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 4. Install NPM dependencies and build frontend
RUN npm install && npm run build

# 5. Ensure storage directories exist
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

# 6. Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# 7. Start nginx + php-fpm
CMD /start.sh
