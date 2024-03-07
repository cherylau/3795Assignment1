FROM php:7.4-apache
RUN apt-get update && apt-get install -y git \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
COPY . /var/www/html/
EXPOSE 80
