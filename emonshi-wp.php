<?php
/*
Plugin Name: Emonshi - Medical Booking System
Plugin URI: https://emonshi.com
Description: Official medical appointment booking system for doctors
Version: 1.0.0
Requires at least: 5.0
Requires PHP: 7.4
Tested up to: 6.7.1
Author: hamyarsystem
Author URI: https://emonshi.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: emonshi-wp
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
    wp_enqueue_style(
        'emonshi-booking-style', 
        EMONSHI_PLUGIN_URL . 'assets/css/web-component.css',
        array(),
        EMONSHI_VERSION
    );
    
    wp_enqueue_script(
        'emonshi-booking-script', 
        EMONSHI_PLUGIN_URL . 'assets/js/web-component.js',
        array(),
        EMONSHI_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'emonshi_booking_enqueue_scripts');

// Add shortcode for booking calendar
function emonshi_booking_shortcode() {
    ob_start();
    ?>
    <div class="emonshi-booking-container">
        <emonshi-nobat></emonshi-nobat>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('emonshi_booking', 'emonshi_booking_shortcode');