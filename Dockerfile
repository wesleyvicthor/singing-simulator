FROM php:7.4-cli-alpine

WORKDIR /usr/src/app

#COPY ./bin/composer /usr/src/app/bin/
#COPY ./composer.* /usr/src/app/

#RUN ./bin/composer install --no-dev --prefer-dist

COPY . /usr/src/app

#ENTRYPOINT ["./bin/console"]
