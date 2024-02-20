FROM php:8.2-apache

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/apache2.conf /etc/apache2/apache2.conf
COPY .docker/hosts /etc/hosts

WORKDIR /srv/htdocs

RUN apt-get update \
        && apt-get install vim -y  \
        && apt-get install kmod -y \    
    && chown -R www-data:www-data /srv/htdocs \
	&& a2enmod rewrite \
	&& docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && apt install net-tools

COPY .docker/xdebug-3.2.1.tgz /files/xdebug-3.2.1.tgz

RUN cd /files \
    && tar -xvzf xdebug-3.2.1.tgz \
    && cd xdebug-3.2.1 \
    && phpize \
    && ./configure \
    && make \
    && cp modules/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20220829/

COPY .docker/99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini  

COPY --from=composer /usr/bin/composer /usr/bin/composer

# ENTRYPOINT ["sh", "-c", "service apache2 start"]
EXPOSE 80
# Copy the startup script to the container
COPY .docker/start.sh /usr/local/bin/start.sh

# Make the startup script executable
RUN chmod +x /usr/local/bin/start.sh

# # Start the startup script as the entry point
# ENTRYPOINT ["/usr/local/bin/start.sh"]