FROM quay.io/renokico/laravel-base:latest-8.1-fpm-alpine

COPY . /var/www/html

RUN mkdir -p /var/www/html/storage/logs/ && \
    chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
