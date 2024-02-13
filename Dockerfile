FROM wordpress:6.1.1

WORKDIR /var/www/html

ENV PROJECT_NAME=project_name

RUN mkdir ./wp-content/themes/${PROJECT_NAME}

COPY ./ ./wp-content/themes/${PROJECT_NAME}

EXPOSE 80
