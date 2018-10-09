FROM php:7.1-apache

RUN apt-get update -qq
RUN apt-get upgrade -qq -y
RUN apt-get -qq install -y apt-utils nano zip unzip libpng-dev libjpeg-dev libpq-dev libicu-dev libmcrypt-dev
RUN apt-get clean

RUN docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr > /dev/null
RUN docker-php-ext-configure intl > /dev/null
RUN docker-php-ext-install pdo_mysql intl bcmath mcrypt zip opcache > /dev/null

ADD . /var/www/elearningadmin
WORKDIR /var/www/elearningadmin

RUN echo "ServerName elearning.net" >> /etc/apache2/apache2.conf

RUN cp ./build/conf.d/* /etc/apache2/sites-available/
RUN cp ./build/ini/php-custom.ini /usr/local/etc/php/conf.d/

RUN a2enmod rewrite && \
    a2enmod expires

RUN a2dissite 000-default.conf
RUN a2ensite elearning-admin.conf

EXPOSE 80
