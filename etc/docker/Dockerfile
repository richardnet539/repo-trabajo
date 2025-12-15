# Define the build argument for the project ID
ARG PROJECT_ID

# Stage 1: Build
FROM wordpress:6.8.1-php8.4 AS build

WORKDIR /var/www/html

# Install dependencies required for Composer
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER=1

# Use GITLAB_TOKEN build argument for authentication (optional)
ARG GITLAB_TOKEN
RUN if [ -n "${GITLAB_TOKEN}" ]; then \
            composer config --global gitlab-token.gitlab.fbr.group "${GITLAB_TOKEN}"; \
        else \
            echo "No GITLAB_TOKEN provided, skipping gitlab token config"; \
        fi

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
RUN if [ -n "${GITLAB_TOKEN}" ]; then \
            composer install --no-interaction --prefer-dist --optimize-autoloader; \
        else \
            echo "No GITLAB_TOKEN provided, skipping composer install (private repos require auth)"; \
        fi

# Stage 2: Final (public image for local development)
FROM wordpress:6.8.1-php8.4-apache

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

# Ensure Nginx and PHP-FPM directories have correct permissions
RUN mkdir -p /var/run/php && \
    chown -R www-data:www-data /var/run/php && \
    chmod -R 700 /var/run/php

EXPOSE 80
