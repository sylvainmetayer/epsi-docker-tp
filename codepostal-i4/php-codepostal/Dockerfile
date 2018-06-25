FROM php:7.2-apache

RUN docker-php-ext-install -j$(nproc) mysqli
RUN pecl install -o -f redis &&  rm -rf /tmp/pear &&  docker-php-ext-enable redis

ADD ./www/* /var/www/html/
