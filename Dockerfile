# Stage 1: Build frontend assets
FROM node:18 as build-frontend

WORKDIR /app

# Copy package.json dan file lock yang diperlukan
COPY package.json webpack.mix.js tailwind.config.js /app/
COPY resources/css /app/resources/css

# Install dependencies dan build assets
RUN npm install && npm run prod

# Stage 2: Build aplikasi Laravel
FROM php:8.2-fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Buat direktori aplikasi
WORKDIR /var/www/html

# Copy file aplikasi
COPY . .

# Copy hasil build frontend dari stage 1
COPY --from=build-frontend /app/public/css /var/www/html/public/css
COPY --from=build-frontend /app/public/js /var/www/html/public/js
COPY --from=build-frontend /app/mix-manifest.json /var/www/html/mix-manifest.json

# Install dependencies PHP
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate key aplikasi
RUN php artisan key:generate

# Optimasi Laravel
RUN php artisan optimize:clear
RUN php artisan optimize
