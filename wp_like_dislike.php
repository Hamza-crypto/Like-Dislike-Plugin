<?php
/**
 * Plugin Name: Like / Dislike
 * Plugin URI: https://www.yourwebsiteurl.com/
 * Description: Add Like and Dislike funtionality to posts.
 * Version: 1.0
 * Author: Hamza
 * Author URI: http://yourwebsiteurl.com/
 **/


if (!defined('WPINC')) {
    die();
}

register_activation_hook(__FILE__, 'ld_create_table');
register_uninstall_hook( __FILE__, 'ld_destroy_table');

if (!defined('LD_PLUGIN_DIR')) {
    define('LD_PLUGIN_DIR', plugin_dir_url(__FILE__));
}


function ld_plugin_scripts()
{
    wp_enqueue_style('ld-css', LD_PLUGIN_DIR . 'assets/css/style.css');
    wp_enqueue_script('ld-script', LD_PLUGIN_DIR . 'assets/js/main.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('ld-ajax', LD_PLUGIN_DIR . 'assets/js/ajax.js', ['jquery'], '1.0.0', true);
    wp_localize_script('ld-ajax', 'ld_ajax_url', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}

add_action('wp_enqueue_scripts', 'ld_plugin_scripts');

require plugin_dir_path(__FILE__) . 'inc/settings.php';
require plugin_dir_path(__FILE__) . 'inc/install.php';
require plugin_dir_path(__FILE__) . 'inc/btn_filter.php';

require plugin_dir_path(__FILE__) . 'inc/ajax_functionality.php';



















