FROM php:7.1-fpm

MAINTAINER Johan van Helden <johan@johanvanhelden.com>

# Set environment variables
ARG TZ=America/Belem
ENV TZ ${TZ}

# Install dependencies
RUN apt-get update
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libcurl4-nss-dev \
        libc-client-dev \
        libkrb5-dev \
        libicu-dev \
        libxml2-dev \
        libxslt1-dev \
        ssmtp \
        libssh2-1-dev \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install -j$(nproc) curl \
    && docker-php-ext-install -j$(nproc) mbstring \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) xmlrpc \
    && docker-php-ext-install -j$(nproc) xsl \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-install zip

# Set the timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install the xdebug extension
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Copy xdebug configration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy the php-fpm config
COPY ./dockerhero.fpm.conf /usr/local/etc/php-fpm.d/zzz-dockerhero.fpm.conf
COPY ./dockerhero.php.ini /usr/local/etc/php/conf.d/dockerhero.php.ini


# Cleanup all downloaded packages
RUN apt-get -y autoclean && apt-get -y autoremove && apt-get -y clean && rm -rf /var/lib/apt/lists/* && apt-get update

# Set the proper permissions
RUN usermod -u 1000 www-data

# Add the startup script and set executable
COPY ./startup.sh /var/scripts/startup.sh
RUN chmod +x /var/scripts/startup.sh

# Run the startup script
CMD ["/var/scripts/startup.sh"]
