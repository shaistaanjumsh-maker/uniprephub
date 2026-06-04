# Multi-stage build for Laravel + Vue + Nginx + Supervisor
FROM node:20-alpine AS node_builder
WORKDIR /var/www/html
COPY package.json package-lock.json* ./
RUN npm install
COPY resources resources
COPY vite.config.js .
RUN npm run build

FROM composer:2.7 AS php_deps
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
COPY . .
RUN composer dump-autoload --optimize --classmap-authoritative

FROM php:8.2-fpm-alpine AS runtime
RUN apk add --no-cache nginx supervisor bash icu-dev libzip-dev oniguruma-dev libpng-dev libjpeg-turbo-dev freetype-dev libwebp-dev zlib-dev curl git
RUN docker-php-ext-configure intl && docker-php-ext-install pdo_mysql bcmath intl opcache

WORKDIR /var/www/html
COPY --from=php_deps /var/www/html /var/www/html
COPY --from=node_builder /var/www/html/public/build /var/www/html/public/build
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /run/nginx /var/log/nginx /var/log/supervisor /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/storage
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod +x /var/www/html/start-render.sh

EXPOSE 80 443
CMD ["bash", "/var/www/html/start-render.sh"]
