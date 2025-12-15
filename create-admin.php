<?php
// Temporary script to create or update an admin user for local development.
// Usage: run inside the web container: php /var/www/html/create-admin.php

$username = getenv('WP_NEW_USER') ?: 'devadmin';
$password = getenv('WP_NEW_PASS') ?: 'ChangeMe123!';
$email = getenv('WP_NEW_EMAIL') ?: 'devadmin@example.com';

if ( ! file_exists(__DIR__ . '/wp-load.php') ) {
    echo "wp-load.php not found in project root. Run this inside the WordPress container where /var/www/html contains WordPress.\n";
    exit(1);
}

require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-includes/pluggable.php';

if ( username_exists($username) ) {
    $user = get_user_by('login', $username);
    wp_set_password( $password, $user->ID );
    echo "Updated password for existing user: $username\n";
    echo "Login with: $username / $password\n";
    exit(0);
}

if ( email_exists($email) ) {
    $user = get_user_by('email', $email);
    wp_set_password( $password, $user->ID );
    $user->user_login = $username;
    wp_update_user($user);
    echo "Updated password for existing email (changed username to $username): $email\n";
    echo "Login with: $username / $password\n";
    exit(0);
}

$user_id = wp_create_user( $username, $password, $email );
if ( is_wp_error($user_id) ) {
    echo "Failed to create user: " . $user_id->get_error_message() . "\n";
    exit(1);
}

$user = new WP_User( $user_id );
$user->set_role('administrator');

echo "Created admin user: $username\n";
echo "Login with: $username / $password\n";
echo "Please delete this file after use for security: create-admin.php\n";

?>
