FROM php:8.2.10-alpine3.18 as os
RUN apk add \
    libzip-dev \
    unzip \
    vim \
    bash
RUN apk add --update linux-headers --update-cache --virtual .build-deps ${PHPIZE_DEPS} \
    && pecl install xdebug-3.2.1 \
    && docker-php-ext-install \
    opcache \
    zip \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps ${PHPIZE_DEPS} \
    && docker-php-source delete

ENV COMPOSER_HOME /.composer
COPY --from=composer/composer:2-bin /composer /usr/bin/composer
COPY .docker/php.ini $PHP_INI_DIR/php.ini
COPY .docker/php/*.ini $PHP_INI_DIR/conf.d/

USER www-data
WORKDIR /app

