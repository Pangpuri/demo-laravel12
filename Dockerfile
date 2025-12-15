FROM php:8.3-cli

# ติดตั้ง dependency ที่จำเป็นสำหรับ Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip gd mbstring

# ติดตั้ง Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files
COPY . .

# ติดตั้ง PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 
RUN chmod -R 775 database storage bootstrap/cache

# Render ใช้ port 10000
EXPOSE 10000

# Start Laravel (serve public folder)
CMD php artisan serve --host 0.0.0.0 --port 10000
