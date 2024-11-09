# phpdocker/php-fpm/Dockerfile
FROM phpdockerio/php:8.3-fpm

# Define o diretório de trabalho
WORKDIR /application

# Instala dependências do sistema e o Composer
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.3-mysql \
        curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
