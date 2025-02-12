# Use the official PHP 8.2 image with necessary extensions
FROM php:8.2-fpm

# Set the working directory inside the container
WORKDIR /var/www/royal-apps-test

# Install system dependencies and required PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/royal-apps-test/storage /var/www/royal-apps-test/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
