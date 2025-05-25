# Stage 1: Build frontend assets (menggunakan Vite)
FROM node:18 as build-frontend

WORKDIR /app

# Copy file yang diperlukan untuk frontend build
COPY package.json package-lock.json tailwind.config.js vite.config.mjs postcss.config.js /app/
COPY resources/ /app/resources/

# Install dependencies dan build assets
RUN npm install && npm run build

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
COPY --from=build-frontend /app/public/build /var/www/html/public/build

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
