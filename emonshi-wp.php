<?php
/*
Plugin Name: Emonshi - Medical Booking System
Plugin URI: https://emonshi.net
Description: Official medical appointment booking system for doctors - Simple and modern appointment booking solution
Version: 1.0.0
Requires at least: 5.0
Requires PHP: 7.4
Author: hamyarsystem
Author URI: https://emonshi.net
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: emonshi-wp
Domain Path: /languages
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
add_shortcode('emonshi_booking', 'emonshi_booking_shortcode');