FROM php:8.2-apache

RUN docker-php-ext-install mysqli \
    && a2enmod rewrite

# Defaults equivalent to XAMPP's.
RUN { \
      echo 'mysqli.default_socket = /run/mysqld/mysqld.sock'; \
      echo 'output_buffering = 4096'; \
      echo 'display_errors = On'; \
      echo 'error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT'; \
      echo 'upload_max_filesize = 40M'; \
      echo 'post_max_size = 40M'; \
      echo 'date.timezone = America/Lima'; \
    } > /usr/local/etc/php/conf.d/arxatec.ini
