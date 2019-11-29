FROM php:7.3-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    rsyslog \
    cron \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    vim \
    nano \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd

RUN docker-php-ext-install \
    intl \
    mbstring \
    pcntl \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    zip \
    tokenizer \
    opcache

RUN docker-php-ext-enable \
    redis

# Put apache config for Laravel
COPY ./docker/apache2.conf /etc/apache2/sites-available/laravel.conf
RUN a2dissite 000-default.conf && a2ensite laravel.conf && a2enmod rewrite

# Change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Install composer
WORKDIR /var/www/html
COPY . /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer global require hirak/prestissimo
RUN composer install

#sudo chmod 644 storage/oauth-*.key

WORKDIR /var/www

#wkhtmltoimage / wkhtmltopdf
RUN apt-get update && apt-get install -y libfontconfig1 libxrender1 libxext6 libx11-dev libjpeg62 libxtst6

WORKDIR /var/www/html
