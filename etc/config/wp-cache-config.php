<?php
/*
 * WP Super Cache Configuration File
 */

$wp_cache_mobile_enabled = 1; // Enable caching for mobile devices
$wp_cache_mobile_browsers = 'Mobile|Android|Silk/|Kindle|BlackBerry|Opera Mini|Opera Mobi'; // List of mobile browsers to cache
$wp_cache_mobile_prefixes = ''; // Custom prefixes for mobile caching

$wp_cache = 1; // Enable caching
$cache_compression = 0; // Compression for cache files
$cache_enabled = true; // Enable cache functionality
$super_cache_enabled = true; // Enable Super Cache functionality
$cache_max_time = 3600; // Cache expiry time in seconds
$cache_path = '/var/www/html/wp-content/cache/'; // Path to the cache directory
$cache_time_interval = '600'; // How often the cache is refreshed (600 = 10 minutes)
$cache_acceptable_files = array( 'wp-comments-popup.php', 'wp-links-opml.php', 'wp-locations.php' ); // Cache these files
$cache_rejected_uri = array( 'wp-.*\.php', 'index\.php' ); // Do not cache these URIs
$cache_rebuild_files = 1; // Enable cache rebuilding
$cache_front_page = 1; // Cache the front page
$cache_gzip = 1; // Enable Gzip compression
$cache_ssl = 1; // Enable caching for SSL (HTTPS) pages
$wp_cache_make_known_anon = 1; // Enable caching for known users
$wp_cache_slash_check = 1; // Check for trailing slashes
$cache_scheduled_time = '00:00'; // When to schedule cache cleaning
$cache_schedule_type = 'interval'; // Schedule type: interval or daily

$cache_page_secret = 'secret_string'; // Secret string for cache files
$cache_rebuild_files = 1; // Rebuild cache files
$cache_gc_email_me = 0; // Disable email notifications for garbage collection
?>
