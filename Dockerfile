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
    nginx \
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

# Copy Nginx config & entrypoint
RUN rm -rf /etc/nginx/sites-enabled/
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY entrypoint.sh ./entrypoint.sh
RUN chmod +x ./entrypoint.sh && chmod -R 777 storage bootstrap/cache

# Expose web (nginx)
EXPOSE 80

# Start both nginx and php-fpm
ENTRYPOINT ["/bin/sh", "./entrypoint.sh"]
