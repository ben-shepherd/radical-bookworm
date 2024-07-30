# Use the official PHP image as the base
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    libssl-dev \
    pkg-config \
    libcurl4-openssl-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install the MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install Laravel dependencies
RUN composer install

# Copy existing application directory permissions
COPY --chown=www-data:www-data . .

# Copy the Nginx configuration file
COPY ./nginx/default.conf /etc/nginx/sites-available/default

# Configure Supervisor to run Nginx and PHP-FPM
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 8000
EXPOSE 8000

# Start Supervisor to manage Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
