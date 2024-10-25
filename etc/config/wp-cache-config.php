<?php
/*
 * Simplified WP Super Cache Configuration File
 */

// Enable caching
$wp_cache = 1;
$cache_enabled = true;
$super_cache_enabled = true;

// Cache expiration time (in seconds)
$cache_max_time = 3600;

// Enable compression for cache files
$cache_gzip = 1;

// Enable caching for mobile devices
$wp_cache_mobile_enabled = 1;

// Enable caching for SSL (HTTPS) pages
$cache_ssl = 1;

// Enable rebuilding cache files
$cache_rebuild_files = 1;

// Set cache expiration and cleaning schedule
$cache_time_interval = 600; // Refresh cache every 10 minutes
$cache_scheduled_time = '00:00'; // Clean cache at midnight
$cache_schedule_type = 'interval'; // Use interval scheduling for cache refresh

// Paths and URIs to be excluded from caching
$cache_rejected_uri = array( 'wp-.*\.php', 'index\.php' );

// Enable caching for known users and ensure trailing slashes are handled
$wp_cache_make_known_anon = 1;
$wp_cache_slash_check = 1;
?>
