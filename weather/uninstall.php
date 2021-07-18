<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @since      1.0.0
 *
 * @package    JF_Weather_Plugin
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove weather cache table
global $wpdb;
$table_name = $wpdb->prefix . '_weather';
$wpdb->query('DROP TABLE IF EXISTS ' . $table_name);
