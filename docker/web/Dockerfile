FROM php:7.2-apache

RUN apt-get update \
    && apt-get -y install vim wget lsb-release libicu-dev mysql-client libfreetype6-dev libxml2-dev libjpeg62-turbo-dev libpng-dev \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml ctype json zip

RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
RUN ln -s /etc/apache2/mods-available/vhost_alias.load /etc/apache2/mods-enabled
RUN echo ServerName $HOSTNAME > /etc/apache2/conf-available/fqdn.conf && a2enconf fqdn

RUN a2dissite 000-default.conf
RUN rm /etc/apache2/sites-available/000-default.conf
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf
