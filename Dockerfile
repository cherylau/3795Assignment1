# Use PHP with Apache as the base image
FROM php:7.4-apache

# Install additional PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your web application files to the container
COPY src/ /var/www/html/

# Adjust permissions to ensure Apache can access them
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

# Expose port 80 for HTTP traffic
EXPOSE 80
