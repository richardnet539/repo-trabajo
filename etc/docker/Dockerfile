RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER=1

# Use GITLAB_TOKEN build argument for authentication
ARG GITLAB_TOKEN
RUN composer config --global gitlab-token.gitlab.fbr.group ${GITLAB_TOKEN}

# Remove default plugins and themes except twentytwentyfour
RUN rm -rf /usr/src/wordpress/wp-content/plugins/* && \
    find /usr/src/wordpress/wp-content/themes/ -mindepth 1 -maxdepth 1 -type d ! -name 'twentytwentyfour' -exec rm -rf {} +

# Copy the custom wp-config.php
COPY /etc/config/wp-config.php /usr/src/wordpress/wp-config.php

# Copy custom theme and other files
ARG THEME_NAME
COPY / /usr/src/wordpress/wp-content/themes/${THEME_NAME}/
COPY /etc/config/composer.json /usr/src/wordpress/composer.json

# Change working directory to /usr/src/wordpress to install plugins
WORKDIR /usr/src/wordpress

# Install plugins using Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: Final
FROM europe-west1-docker.pkg.dev/${PROJECT_ID}/wordpress/nginx-php-fpm-alpine:latest

# Copy Nginx configuration
COPY /etc/nginx/default.conf /etc/nginx/conf.d/default.conf

# Ensure the necessary directories exist for Nginx temporary files
RUN mkdir -p /tmp/nginx/client_body /tmp/nginx/proxy /tmp/nginx/fastcgi && \
    chown -R www-data:www-data /tmp/nginx && \
    chmod -R 755 /tmp/nginx

WORKDIR /var/www/html