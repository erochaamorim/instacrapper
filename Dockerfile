FROM php:7.3-apache

RUN apt update && apt install -y git && apt install -y make && apt install -y unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
