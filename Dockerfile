FROM php:8.2-apache

# Cài đặt extension mysqli để PHP kết nối được với MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Bật mod_rewrite của Apache để file .htaccess của mô hình MVC hoạt động
RUN a2enmod rewrite

# Cho phép .htaccess ghi đè cấu hình (Sửa lỗi 404 Not Found)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Đảm bảo quyền truy cập cho thư mục web
RUN chown -R www-data:www-data /var/www/html
