<?php
/*
Plugin Name: Emonshi - Medical Booking System
Plugin URI: https://emonshi.com
Description: Official medical appointment booking system for doctors
Version: 1.0.0
Requires at least: 5.0
Requires PHP: 7.4
Author: hamyarsystem
Author URI: https://emonshi.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: emonshi-wp
Domain Path: /languages
GitHub Plugin URI: rokinio/Emonshi-wp
GitHub Branch: main
Update URI: false
*/
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('EMONSHI_VERSION', '1.0.0');
define('EMONSHI_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EMONSHI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Enqueue scripts and styles
function emonshi_booking_enqueue_scripts() {
    $version = EMONSHI_VERSION;
    
    wp_enqueue_style(
        'emonshi-booking-style', 
        EMONSHI_PLUGIN_URL . 'assets/css/web-component.css', 
        array(), 
        $version
    );
    
    wp_enqueue_script(
        'emonshi-booking-script', 
        EMONSHI_PLUGIN_URL . 'assets/js/web-component.js', 
        array(), 
        $version, 
        true
    );
}
add_action('wp_enqueue_scripts', 'emonshi_booking_enqueue_scripts');

// Plugin activation hook
function emonshi_booking_activate() {
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'emonshi_booking_activate');

// Plugin deactivation hook
function emonshi_booking_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'emonshi_booking_deactivate');

// Add shortcode for booking calendar
function emonshi_booking_shortcode() {
    return '<div id="emonshi-booking-calendar"></div>';
}

if (!defined('EMONSHI_UPDATE_SOURCE')) {
    // Check if plugin is installed from WordPress.org
    if (false !== strpos(__FILE__, 'wp-content/plugins')) {
        define('EMONSHI_UPDATE_SOURCE', 'wordpress.org');
    } else {
        define('EMONSHI_UPDATE_SOURCE', 'github');
    }
}

// Disable GitHub updates if installed from WordPress.org
if (EMONSHI_UPDATE_SOURCE === 'wordpress.org') {
    add_filter('github_updater_hide_settings', '__return_true');
}

add_shortcode('emonshi_booking', 'emonshi_booking_shortcode');