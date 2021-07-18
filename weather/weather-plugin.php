<?php

/**
 * Weather plugin bootstrap file
 *
 * This is a sample Wordpress plugin written by Jeremy J Fall.  It demonstrates:
 *  - Activation/Deactivation (creates and removes a DB table)
 *  - Use of the Wordpress Plugin API
 *  - Use of the WP Admin and custom settings
 *  - Shortcode usage
 *  - Widget usage
 *
 * @since             1.0.0
 * @package           JF_Weather_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Weather Plugin
 * Description:       This is a sample Wordpress plugin written by Jeremy J Fall.
 * Version:           1.0.0
 * Author:            Jeremy J Fall
 * Author URI:        https://www.linkedin.com/in/falljer/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-weather-plugin-activator.php';
	JF_Weather_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-weather-plugin-deactivator.php';
	JF_Weather_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-weather-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_weather_plugin() {

	$plugin = new JF_Weather_Plugin();
	$plugin->run();

}
run_weather_plugin();
