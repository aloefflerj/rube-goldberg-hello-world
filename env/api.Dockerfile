FROM php:8.2-apache
WORKDIR /var/www/html
EXPOSE 80
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
        wget \
        unzip \
        git

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions mysqli pdo pdo_mysql ds

RUN a2enmod rewrite && service apache2 restart

COPY ./api .
COPY --from=composer:2.3.7 /usr/bin/composer /usr/bin/composer

COPY ./env/vhost.conf /etc/apache2/sites-available/000-default.conf

USER ${UID}:${GID}

RUN composer install

ARG UID
ARG GID
RUN chown -R ${UID}:${GID} /var/www/html
RUN chown -R ${UID}:${GID} /root/.composer
