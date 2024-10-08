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
    libcurl4-openssl-dev \
    libpq-dev \
    libzip-dev \
    libicu-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Install PostgreSQL extension
RUN docker-php-ext-install pdo_pgsql

# Install XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Configure XDebug
RUN echo "xdebug.mode=debug,develop" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only necessary files for composer install
COPY composer.json composer.lock ./

# Copy .env file
COPY .env.example .env

# Install Laravel dependencies
RUN composer install --no-scripts --no-autoloader

# Copy existing application directory contents
COPY . .

# Generate autoloader and run scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Copy the Nginx configuration file
COPY ./nginx/default.conf /etc/nginx/sites-available/default

# Configure Supervisor to run Nginx and PHP-FPM
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose ports 8000 and 9003 (XDebug)
EXPOSE 8000 9003

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Set the startup script as the entry point
CMD ["/start.sh"]
