FROM php:8.1-apache

# Install system dependencies and PHP extensions (including mysqli for DB, and gd/zip for Excel export/import if needed)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli zip \
    && docker-php-ext-enable mysqli gd zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache Mod Rewrite for .htaccess redirection
RUN a2enmod rewrite

# Configure Apache to allow .htaccess overrides in all directories
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Set working directory to Apache root
WORKDIR /var/www/html

# Copy the project files to a subdirectory "Baitaplon" to match XAMPP path settings
COPY . /var/www/html/Baitaplon

# Create a redirection index.php at the root so that visiting http://localhost redirects to http://localhost/Baitaplon/
RUN echo '<?php header("Location: /Baitaplon/"); exit; ?>' > /var/www/html/index.php

# Ensure proper folder ownership for Apache's www-data user
RUN chown -R www-data:www-data /var/www/html

# Expose HTTP port
EXPOSE 80
