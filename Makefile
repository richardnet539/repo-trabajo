# Makefile to download and setup WordPress

# Variables
WP_VERSION=6.4.3
WP_FILE=wordpress-$(WP_VERSION).tar.gz
WP_URL=https://wordpress.org/$(WP_FILE)
WP_DIR=/var/www/html/
VERSION_FILE=wp-includes/version.php

all: check_wp_exists download extract move_wp clean

check_wp_exists:
	@if [ -d "$(WP_DIR)wordpress" ] && [ -f "$(WP_DIR)wordpress/$(VERSION_FILE)" ]; then \
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

clean: 
	@echo "Cleaning up..."
	@rm -rf $(WP_FILE)

.PHONY: all check_wp_exists download extract move_wp clean
