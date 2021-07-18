<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    JF_Weather_Plugin
 * @subpackage JF_Weather_Plugin/includes
 * @author     Jeremy Fall <falljer@gmail.com>
 */
class JF_Weather_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		$sql = file_get_contents( plugin_dir_path(__FILE__) . "../database/weather.sql" );
		$sql = str_replace('{prefix}', $wpdb->prefix, $sql);
		dbDelta( $sql );
	}

}
