# Makefile to download and setup WordPress

# Variables
WP_VERSION=6.4.3
WP_FILE=wordpress-$(WP_VERSION).tar.gz
WP_URL=https://wordpress.org/$(WP_FILE)
WP_DIR=/var/www/html/
DB_ROOT_USER=root
DB_NAME ?= $(LIGA_DEBATE_DB_NAME)
DB_USER ?= $(LIGA_DEBATE_DB_USER)
DB_PASS ?= $(LIGA_DEBATE_DB_PASSWORD)
DB_HOST ?= $(LIGA_DEBATE_DB_HOST)
VERSION_FILE=wp-includes/version.php

all: setup_db check_wp_exists download extract move_wp configure_wp clean

setup_db:
	@echo "Setting up MariaDB Database and User..."
	@mysql -u$(DB_ROOT_USER) -e "CREATE DATABASE IF NOT EXISTS $(DB_NAME);"
	@mysql -u$(DB_ROOT_USER) -e "CREATE USER IF NOT EXISTS '$(DB_USER)'@'$(DB_HOST)' IDENTIFIED BY '$(DB_PASS)';"
	@mysql -u$(DB_ROOT_USER) -e "GRANT ALL PRIVILEGES ON $(DB_NAME).* TO '$(DB_USER)'@'$(DB_HOST)';"
	@mysql -u$(DB_ROOT_USER) -e "FLUSH PRIVILEGES;"

check_wp_exists:
	@if [ -d "$(WP_DIR)/wp-content" ] && [ -f "$(WP_DIR)/$(VERSION_FILE)" ]; then \
		echo "WordPress already exists in $(WP_DIR)."; \
		grep -q '$(WP_VERSION)' "$(WP_DIR)wordpress/$(VERSION_FILE)" && { \
			echo "Version $(WP_VERSION) is already installed."; \
			exit 1; \
		} || echo "A different version of WordPress is installed."; \
	fi

download:
	@echo "Downloading WordPress..."
	@curl -O $(WP_URL)

extract:
	@echo "Extracting WordPress..."
	@tar -zxvf $(WP_FILE) -C $(WP_DIR)

move_wp:
	@echo "Moving WordPress files..."
	@if [ -f "$(WP_DIR)index.html" ]; then \
		echo "Deleting existing index.html"; \
		rm -f "$(WP_DIR)index.html"; \
	fi
	@echo "Moving WordPress to root directory..."
	@mv -f $(WP_DIR)wordpress/* $(WP_DIR)
	@mv -f $(WP_DIR)wordpress/.* $(WP_DIR) 2>/dev/null || true
	@rmdir $(WP_DIR)wordpress


configure_wp:
	@echo "Configuring WordPress..."
	@if [ ! -f "$(WP_DIR)wp-config.php" ]; then \
		cp "$(WP_DIR)wp-config-sample.php" "$(WP_DIR)wp-config.php"; \
		sed -i "s/database_name_here/$(DB_NAME)/g" "$(WP_DIR)wp-config.php"; \
		sed -i "s/username_here/$(DB_USER)/g" "$(WP_DIR)wp-config.php"; \
		sed -i "s/password_here/$(DB_PASS)/g" "$(WP_DIR)wp-config.php"; \
		sed -i "s/localhost/$(DB_HOST)/g" "$(WP_DIR)wp-config.php"; \
	else \
		echo "wp-config.php already exists."; \
	fi
	# Optionally, secure the installation by configuring salts
	@curl -s https://api.wordpress.org/secret-key/1.1/salt/ > wp-salts.txt
	@sed -i '/AUTH_KEY/d' "$(WP_DIR)wp-config.php"
	@sed -i '/SECURE_AUTH_KEY/d' "$(WP_DIR)wp-config.php"
	@sed -i '/LOGGED_IN_KEY/d' "$(WP_DIR)wp-config.php"
	@sed -i '/NONCE_KEY/d' "$(WP_DIR)wp-config.php"
	@sed -i '/AUTH_SALT/d' "$(WP_DIR)wp-config.php"
	@sed -i '/SECURE_AUTH_SALT/d' "$(WP_DIR)wp-config.php"
	@sed -i '/LOGGED_IN_SALT/d' "$(WP_DIR)wp-config.php"
	@sed -i '/NONCE_SALT/d' "$(WP_DIR)wp-config.php"
	@sed -i '/put your unique phrase here/r wp-salts.txt' "$(WP_DIR)wp-config.php"
	@rm wp-salts.txt

clean: 
	@echo "Cleaning up..."
	@rm -rf $(WP_FILE)

.PHONY: all check_wp_exists download extract move_wp clean
