FROM wordpress:6.4.3

WORKDIR /var/www/html

ENV PROJECT_NAME="liga-de-debate"
# Install Node.js and npm
RUN apt-get update && \
    apt-get install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN mkdir ./wp-content/themes/${PROJECT_NAME}

COPY ./ ./wp-content/themes/${PROJECT_NAME}

WORKDIR /var/www/html/wp-content/themes/${PROJECT_NAME}

RUN npm install --only=production && \
    npm run build-css && \
    rm -rf node_modules

WORKDIR /var/www/html

VOLUME /var/www/html/wp-content/uploads
VOLUME /var/www/html/wp-content/plugins

EXPOSE 80