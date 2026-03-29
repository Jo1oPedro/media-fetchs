FROM php:8.4-cli

ARG APP_DIR=/var/www/app
ARG APP_ENV=local

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
    curl \
    libcurl4-openssl-dev \
    libssl-dev \
    supervisor

RUN docker-php-ext-install pcntl sockets mysqli pdo pdo_mysql session \
    && pecl install swoole \
    && docker-php-ext-enable swoole

RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

WORKDIR $APP_DIR
RUN chown www-data:www-data $APP_DIR

COPY --chown=www-data:www-data . .

COPY composer.* ./

RUN npm install -g chokidar

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN rm -rf vendor && rm -rf node_modules \
    && composer install --prefer-dist --no-scripts --no-progress --no-interaction \
    $(if [ "$APP_ENV" = "production" ]; then echo "--no-dev"; fi) \
    && composer dump-autoload --optimize

RUN npm install && npm run build && rm -f public/hot

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
