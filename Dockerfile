# Chọn image PHP với một số extension cần thiết
FROM php:8.2-fpm

# Cài đặt các dependencies cần thiết (với composer và các PHP extensions)
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zlib1g-dev libzip-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Chuyển đến thư mục ứng dụng của bạn
WORKDIR /var/www

# Copy các file ứng dụng vào container
COPY . .

# Cài đặt các package của ứng dụng (bao gồm cả dependencies từ composer)
RUN composer install --no-dev --optimize-autoloader

# Cấp quyền cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
EXPOSE 8000
# Đặt lệnh chạy ứng dụng Laravel (Sử dụng php-fpm hoặc artisan serve)
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

