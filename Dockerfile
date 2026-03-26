FROM php:8.2-cli

ARG APP_DIR=/var/www/app

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends curl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends \
    nodejs \
    libpq-dev \
    zip \
    unzip \
    p7zip-full \
    telnet \
    curl

RUN docker-php-ext-install sockets mysqli pdo pdo_mysql session

RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

WORKDIR $APP_DIR
RUN chown www-data:www-data $APP_DIR

COPY --chown=www-data:www-data . .

COPY composer.* ./

RUN rm -rf vendor && rm -rf node_modules \
    && composer install --prefer-dist --no-scripts --no-progress --no-interaction \
    && composer dump-autoload --optimize
