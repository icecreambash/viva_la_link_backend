FROM dockerhub.timeweb.cloud/php:8.2-fpm
ARG WORKDIR=/var/www/html
ENV DOCUMENT_ROOT=${WORKDIR}
ENV LARAVEL_PROCS_NUMBER=1
ENV NODE_MAJOR=20
ARG GROUP_ID=1000
ARG USER_ID=1000
ENV USER_NAME=www-data
ARG GROUP_NAME=www-data
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    librdkafka-dev \
    libpq-dev \
    openssh-server \
    zip \
    unzip \
    supervisor \
    sqlite3  \
    nano \
    cron
# Install Nodejs
RUN apt-get update && apt-get install -y ca-certificates curl gnupg
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list
RUN apt-get update &&  apt-get install nodejs -y

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install Kafka
RUN git clone https://github.com/arnaud-lb/php-rdkafka.git\
    && cd php-rdkafka \
    && phpize \
    && ./configure \
    && make all -j 5 \
    && make install

# Install Rdkafka and enable it
RUN docker-php-ext-enable rdkafka \
     && cd .. \
    && rm -rf /php-rdkafka

# Install PHP extensions zip, mbstring, exif, bcmath, intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install  zip mbstring exif pcntl bcmath -j$(nproc) gd intl

# Install Redis and enable it
RUN pecl install redis  && docker-php-ext-enable redis



# Install the php memcached extension
RUN pecl install memcached && docker-php-ext-enable memcached

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_pgsql

# Install PHP Opcache extention
RUN docker-php-ext-install opcache


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR $WORKDIR

RUN rm -Rf /var/www/* && \
mkdir -p /var/www/html

#ADD src/index.php $WORKDIR/index.php
#ADD src/php.ini $PHP_INI_DIR/conf.d/
#ADD src/opcache.ini $PHP_INI_DIR/conf.d/
#ADD src/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

#COPY src/entrypoint.sh /usr/local/bin/
#RUN chmod +x /usr/local/bin/entrypoint.sh
#RUN ln -s /usr/local/bin/entrypoint.sh /

#ENTRYPOINT ["entrypoint.sh"]

RUN usermod -u ${USER_ID} ${USER_NAME}
RUN groupmod -g ${USER_ID} ${GROUP_NAME}
RUN chown -R ${USER_NAME}:${GROUP_NAME} /var/www && \
  chown -R ${USER_NAME}:${GROUP_NAME} /var/log/ && \
  chown -R ${USER_NAME}:${GROUP_NAME} /etc/supervisor/conf.d/ && \
  chown -R ${USER_NAME}:${GROUP_NAME} $PHP_INI_DIR/conf.d/ && \
  chown -R ${USER_NAME}:${GROUP_NAME} /tmp

EXPOSE 9000
#CMD [ "entrypoint" ]
