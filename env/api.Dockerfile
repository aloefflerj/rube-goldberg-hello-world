FROM php:8.2-apache
WORKDIR /var/www/html
EXPOSE 80
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
        wget \
        unzip \
        git
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite && service apache2 restart
RUN docker-php-ext-install pdo pdo_mysql
COPY ./api .
COPY --from=composer:2.3.7 /usr/bin/composer /usr/bin/composer

COPY ./env/vhost.conf /etc/apache2/sites-available/000-default.conf

USER ${UID}:${GID}

RUN composer install

ARG UID
ARG GID
RUN chown -R ${UID}:${GID} /var/www/html
RUN chown -R ${UID}:${GID} /root/.composer
