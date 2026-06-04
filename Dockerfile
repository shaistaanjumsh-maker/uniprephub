# ==========================
# Stage 1 - Frontend Build
# ==========================
FROM node:20-alpine AS node_builder

WORKDIR /var/www/html

COPY package*.json ./

RUN npm install

# Copy complete project
COPY . .

RUN npm run build

# ==========================
# Stage 2 - Composer Install
# ==========================
FROM composer:2.7-alpine AS php_deps

WORKDIR /var/www/html

RUN apk add --no-cache \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    zlib-dev

COPY composer.json composer.lock ./

RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        intl \
        opcache \
        gd

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction

COPY . .

RUN composer dump-autoload \
    --optimize \
    --classmap-authoritative

# ==========================
# Stage 3 - Runtime
# ==========================
FROM php:8.2-fpm-alpine AS runtime

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    git \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    zlib-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp

RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    intl \
    opcache \
    gd

WORKDIR /var/www/html

COPY --from=php_deps /var/www/html /var/www/html

COPY --from=node_builder /var/www/html/public/build /var/www/html/public/build

COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p \
    /run/nginx \
    /var/log/nginx \
    /var/log/supervisor \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public/storage

RUN chmod +x /var/www/html/start-render.sh

RUN chown -R www-data:www-data /var/www/html

RUN chmod -R 775 /var/www/html/storage

RUN chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["bash", "/var/www/html/start-render.sh"]