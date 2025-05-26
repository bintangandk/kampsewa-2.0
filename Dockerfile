
FROM node:22-bookworm-slim as node-builder

WORKDIR /app
COPY . .
RUN npm ci && npm run build && cp public/build/.vite/manifest.json public/build

# Stage 2: Build aplikasi Laravel - Diperbaiki dengan optimasi
FROM php:8.2-fpm

# Install system dependencies dengan optimasi
RUN apt-get update -o Acquire::Retries=3 && \
    apt-get install -y --no-install-recommends \
    nginx \
    git \
    netcat-openbsd \
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
COPY --from=node-builder /app/public/build /var/www/public/build
COPY --from=node-builder /app/public/build/.vite/manifest.json /var/www/public/build/

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
