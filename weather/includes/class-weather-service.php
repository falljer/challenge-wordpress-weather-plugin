<?php

/**
 * AJAX Service that provides weather data
 *
 * @package    JF_Weather_Plugin
 * @subpackage JF_Weather_Plugin/includes
 * @author     Jeremy Fall <falljer@gmail.com>
 */
class JF_Weather_Plugin_Service {
	public static $base_uri = 'https://api.openweathermap.org/data/2.5/onecall';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Returns JSON for AJAX Service
	 *
	 * @since    1.0.0
	 */
	public function get_weather() {
		echo json_encode(self::current_weather());
		wp_die();
	}

	/**
	 * Collects weather data from service or pulls from cache
	 *
	 * @since    1.0.0
	 */
	public static function current_weather() {
		global $wpdb;
		$api_key = get_option('JF_Weather_Plugin_api_key');
		$lat = get_option('JF_Weather_Plugin_lat');
		$lng = get_option('JF_Weather_Plugin_lng');

		$cache = $wpdb->query("SELECT * FROM {$wpdb->prefix}weather WHERE created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ORDER BY created_at DESC LIMIT 1");
		if(!$cache) {
			$response = wp_remote_get(self::$base_uri . "?lat={$lat}&lon={$lng}&appid={$api_key}&units=imperial");
			$wpdb->insert($wpdb->prefix . 'weather', array(
				'data' => $response['body'],
				'created_at' => date('Y-m-d H:i:s')
			));
			return json_decode($response['body']);
		} else {
			$data = ($wpdb->last_result && count($wpdb->last_result) > 0) ? $wpdb->last_result[0]->data : 'error';
			return json_decode($data);
		}
	}
}
