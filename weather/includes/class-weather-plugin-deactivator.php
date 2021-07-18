<?php

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package    JF_Weather_Plugin
 * @subpackage JF_Weather_Plugin/includes
 * @author     Jeremy Fall <falljer@gmail.com>
 */
class JF_Weather_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Remove weather cache table
		global $wpdb;
		$table_name = $wpdb->prefix . '_weather';
		$wpdb->query('DROP TABLE IF EXISTS ' . $table_name);
	}

}
