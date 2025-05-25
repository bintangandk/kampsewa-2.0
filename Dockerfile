# Stage 1: Build frontend assets - Diperbaiki dengan penanganan error yang lebih baik
FROM node:18 AS build-frontend

WORKDIR /app

# Pertama copy package.json dan lock file saja untuk memanfaatkan cache Docker
COPY package.json package-lock.json ./

# Verifikasi file konfigurasi sebelum copy
RUN if [ ! -f package.json ]; then echo "Error: package.json not found" && exit 1; fi

# Install dependencies terlebih dahulu untuk caching
RUN npm install

# Copy file konfigurasi dan source code
COPY tailwind.config.js postcss.config.js vite.config.mjs ./
COPY resources ./resources

# Verifikasi file vite.config
RUN if [ ! -f vite.config.mjs ]; then \
    echo "Error: vite.config.mjs not found. Available files:" && ls -la && exit 1; \
    fi

# Build assets
RUN npm run build

# Stage 2: Build aplikasi Laravel - Diperbaiki dengan optimasi
FROM php:8.2-fpm

# Install system dependencies dengan optimasi
RUN apt-get update -o Acquire::Retries=3 && \
    apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions dengan optimasi
RUN docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy aplikasi dengan pengecualian
COPY . .

# Copy hasil build frontend
COPY --from=build-frontend /app/public/build /var/www/html/public/build

# Install PHP dependencies dengan cache optimasi
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Setup storage dengan permission yang benar
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Generate key dengan fallback yang lebih baik
RUN if [ ! -f .env ]; then \
    if [ -f .env.example ]; then \
        cp .env.example .env; \
    else \
        echo "Neither .env nor .env.example found!" && exit 1; \
    fi; \
    fi && \
    php artisan key:generate

# Optimasi Laravel
RUN php artisan storage:link && \
    php artisan optimize:clear && \
    php artisan optimize

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost:8080 || exit 1

EXPOSE 9000
CMD ["php-fpm"]
