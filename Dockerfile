# Sử dụng PHP 8.2
FROM php:8.2-fpm

# Cài đặt các extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www

# Sao chép toàn bộ mã nguồn vào Docker container
COPY . .

# Cài đặt các thư viện PHP
RUN composer install

# Thiết lập quyền cho thư mục storage và cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Mở cổng 8000
EXPOSE 8000

# Khởi động ứng dụng
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
