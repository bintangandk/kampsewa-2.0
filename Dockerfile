# Stage 1: Build frontend assets
FROM node:18 as build-frontend

WORKDIR /app

# Copy package.json dan file lock yang diperlukan
COPY package.json package-lock.json* /app/
COPY tailwind.config.js /app/
COPY vite.config.mjs /app/  # Menggunakan vite.config.mjs yang ada di proyek Anda
COPY resources/ /app/resources/

# Install dependencies dan build assets
RUN npm install && npm run build  # Menggunakan npm run build untuk Vite

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
    libzip-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Buat direktori aplikasi
WORKDIR /var/www/html

# Copy file aplikasi (termasuk .env jika ada)
COPY . .

# Copy hasil build frontend dari stage 1
COPY --from=build-frontend /app/public/build /var/www/html/public/build  # Path build Vite

# Install dependencies PHP
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN mkdir -p /var/www/html/storage/framework/{cache,sessions,testing,views} && \
    mkdir -p /var/www/html/storage/logs && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate key aplikasi hanya jika .env ada
RUN if [ -f .env ]; then \
        php artisan key:generate; \
    else \
        cp .env.example .env && \
        php artisan key:generate; \
    fi

# Optimasi Laravel
RUN php artisan optimize:clear && \
    php artisan optimize
