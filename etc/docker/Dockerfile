# Define the build argument for the project ID
ARG PROJECT_ID

# Stage 1: Build
FROM wordpress:6.6.2-php8.3-apache AS build

WORKDIR /var/www/html

# Install dependencies required for Composer
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
RUN composer config --global gitlab-token.code.ctdesarrollo-sdr.org ${GITLAB_TOKEN}

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

COPY /etc/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

# Copy necessary files from build stage
COPY --from=build /usr/src/wordpress /var/www/html
COPY --from=build /usr/src/wordpress/wp-config.php /var/www/html/wp-config.php
COPY --from=build /usr/src/wordpress/wp-content/themes/${THEME_NAME} /var/www/html/wp-content/themes/${THEME_NAME}
COPY --from=build /usr/src/wordpress/wp-content/themes/twentytwentyfour /var/www/html/wp-content/themes/twentytwentyfour
COPY --from=build /usr/src/wordpress/wp-content/plugins /var/www/html/wp-content/plugins
COPY --from=build /usr/src/wordpress/composer.json /var/www/html/composer.json

# Ensure wp-content/upgrade directory exists
RUN mkdir -p wp-content/upgrade

# Set ownership and permissions for the entire /var/www/html directory
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80
