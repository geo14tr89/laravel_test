FROM php:8.0.5-fpm-alpine

ADD ./php.ini /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl channel-update pecl.php.net

RUN apk add --no-cache --update --virtual buildDeps autoconf

RUN apk add build-base

RUN pecl install xdebug