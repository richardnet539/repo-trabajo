FROM wordpress:6.4.3

WORKDIR /var/www/html

ENV PROJECT_NAME="liga-de-debate"

RUN mkdir ./wp-content/themes/${PROJECT_NAME}

COPY ./ ./wp-content/themes/${PROJECT_NAME}

VOLUME /var/www/html/wp-content/uploads

EXPOSE 80