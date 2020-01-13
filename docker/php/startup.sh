#!/bin/bash

#sed -i "s/xdebug\.remote_host\=.*/xdebug\.remote_host\=$XDEBUG_HOST/g" /usr/local/etc/php/conf.d/xdebug.ini

# php-fpm must be started in the foreground
php-fpm
