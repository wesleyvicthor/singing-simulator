FROM php:7.4-cli-alpine

WORKDIR /usr/src/app

RUN docker-php-ext-install pdo pdo_mysql

COPY ./bin/composer /usr/src/app/bin/
COPY ./composer.* /usr/src/app/

RUN ./bin/composer update --no-dev --prefer-dist

COPY . /usr/src/app
