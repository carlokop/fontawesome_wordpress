<?php
/*
Plugin Name: Font Awesome
Description: Loads Font Awesome local
Author: Carlo Kop
Version: 1.0.0
Author URI: https://www.websitediewerkt.nl
Text Domain: font-awesome-local
*/

if (!defined('ABSPATH')) {
    die;
}

//Define constant variables
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', "Font Awesome local");
define('PLUGIN_OPTIONS',get_option('font_awesome_local_plugin_options'));
define('DS','/');

require_once('Inc/Modules/Activate.php');
require_once('Inc/Modules/Deactivate.php');
require_once('Inc/Init.php');

//On plugin activation
function activatePlugin() {
    Inc\Modules\Activate::activate();
}

//On plugin deactivation
function deactivatePlugin() {
    Inc\Modules\Deactivate::deactivate();
}

//activate deactivate hooks
register_activation_hook(__FILE__, 'activatePlugin');
register_deactivation_hook(__FILE__, 'deactivatePlugin');

//start init file
if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}

