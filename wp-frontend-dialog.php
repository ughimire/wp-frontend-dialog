<?php
/*
Plugin Name: WP Frontend Dialog
Plugin URI: http://umeshghimire.com.np
Description: frontend dialog plugin for wordpress
Author: Umesh Ghimire
Author URI: http://umeshghimire.com.np
Text Domain: wp-frontend-dialog
Domain Path: /lang/
Version: 1.0
*/

// Plugin Name and its version
define('WP_FD', '1.0');

//ini_set('display_errors', 0);

//error_reporting(0);

// Text Domain
define('WP_FD_TEXT_DOMAIN', 'wp-frontend-dialog');


// Plugin label
define('WP_FD_LABEL', 'Frontend Dialog');


// Required minimum version of wordpress to install this plugin
define('WP_FD_MIN_WORDPRESS_VERSION', '4.6');


// Required minimum php version
define('WP_FD_MIN_PHP_VERSION', '5.0');


// Plugin file path
define('WP_FD_PLUGIN', __FILE__);


// base path for plugin
define('WP_FD_BASE', plugin_basename(WP_FD_PLUGIN));


// Plugin NAME
define('WP_FD_PLUGIN_NAME', trim(dirname(WP_FD_BASE), '/'));


// plugin directory
define('WP_FD_PLUGIN_DIR', untrailingslashit(dirname(WP_FD_PLUGIN)));

// packages path
define('WP_FD_PLUGIN_PACKAGES_DIR', WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . WP_FD_PLUGIN_NAME . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR);// packages path
// Language Dir
define('WP_FD_PLUGIN_LANGUAGE_DIR', str_replace("/", DIRECTORY_SEPARATOR, str_replace("\\", DIRECTORY_SEPARATOR, WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . WP_FD_PLUGIN_NAME . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR)));

// packages path
define('WP_FD_PLUGIN_HELPER_DIR', WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . WP_FD_PLUGIN_NAME . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR);

// template  directory path
define('WP_FD_PLUGIN_TEMPLATES_DIR', WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . WP_FD_PLUGIN_NAME . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);


// plugin directory
define('WP_FD_PLUGIN_URL', plugins_url('/', WP_FD_PLUGIN));


if (!class_exists('FDLoader')) {

    // Don't activate on anything less than PHP WP_FD_MIN_PHP_VERSION or WordPress WP_FD_MIN_WORDPRESS_VERSION
    if (version_compare(PHP_VERSION, WP_FD_MIN_PHP_VERSION, '<') || version_compare(get_bloginfo('version'), WP_FD_MIN_WORDPRESS_VERSION, '<') || !function_exists('spl_autoload_register')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        deactivate_plugins(__FILE__);
        die('BackWPup requires PHP version 5.2.7 with spl extension or greater and WordPress 3.8 or greater.');
    }
    //Start this plugin
    if (function_exists('add_filter')) {

        add_action('plugins_loaded', array('FDLoader', 'fdLoad'), 11);

        require_once WP_FD_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'FDLoader.php';
    }

    /*add_filter('locale', 'wp_frontend_dialog_locale');
    function wp_frontend_dialog_locale($locale) {
        if ( !is_admin() ) {
            return 'ne_NP';
        }

        return $locale;
    }*/
}
?>
