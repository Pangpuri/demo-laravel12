# Stage 1: Node build
FROM node:18 AS node
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP + Apache
FROM php:8.2-apache
WORKDIR /var/www/html

# ติดตั้ง dependency ที่จำเป็นสำหรับ Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip gd mbstring

# ติดตั้ง Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Copy assets ที่ build แล้วจาก Node stage
COPY --from=node /app/public /var/www/html/public

# ติดตั้ง PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# ให้สิทธิ์เขียน
RUN chmod -R 775 database storage bootstrap/cache

# Render ใช้ port 10000
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host 0.0.0.0 --port 10000
