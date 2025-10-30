FROM git.meshkee.com/packages/standard-laravel:8.2-fpm

WORKDIR /var/www/html

RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

COPY composer.json composer.lock /var/www/html/

RUN composer install --no-dev --no-scripts --optimize-autoloader

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8200

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8200"]
