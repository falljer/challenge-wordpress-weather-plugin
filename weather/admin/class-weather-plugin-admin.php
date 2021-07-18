<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    JF_Weather_Plugin
 * @subpackage JF_Weather_Plugin/admin
 * @author     Jeremy Fall <falljer@gmail.com>
 */
class JF_Weather_Plugin_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/weather-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/weather-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Fields for Settings Section
	 *
	 * @since   1.0.0
	 */
	public function register_fields() {
		add_settings_section(
			'jf_weather_general_section',
			'OpenWeatherMap.org Settings',
			null,
			'jf_weather_general_settings'
		);

		$this->add_text_setting('api_key', 'API Key', 'jf_weather_general_settings', 'jf_weather_general_section');
		$this->add_text_setting('lat', 'Latitude', 'jf_weather_general_settings', 'jf_weather_general_section');
		$this->add_text_setting('lng', 'Longitude', 'jf_weather_general_settings', 'jf_weather_general_section');

	}

	/**
	 * Register Admin Menus
	 *
	 * @since   1.0.0
	 */
	public function admin_menus() {
		add_menu_page(
			'Weather Settings',
			'Weather',
			'administrator',
			$this->plugin_name,
			array($this, 'display_weather_settings'),
			'dashicons-palmtree',
			26);
	}

	/**
	 * Display Weather Settings Page
	 *
	 * @since   1.0.0
	 */
	public function display_weather_settings() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/weather-admin-settings-display.php';
	}

	/**
	 * Display Settings Text Field
	 *
	 * @since   1.0.0
	 */
	public function display_text_field($args) {
		$wp_data_value = get_option($args['name']);
		echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="' . esc_attr($wp_data_value) . '" />';
	}

	/**
	 * Add Text Settings Field to Wordpress
	 *
	 * @since   1.0.0
	 */
	private function add_text_setting($name, $title, $page, $section) {
		add_settings_field(
			$this->plugin_name . '_' . $name,
			$title,
			array( $this, 'display_text_field' ),
			$page,
			$section,
			array(
				'type'              => 'input',
				'subtype'           => 'text',
				'id'                => $this->plugin_name . '_' . $name,
				'name'              => $this->plugin_name . '_' . $name,
				'required'          => 'true',
				'get_options_list'  => '',
				'value_type'        => 'normal',
				'wp_data'           => 'option'
			)
		);

		register_setting(
			$page,
			$this->plugin_name . '_' . $name
		);
	}

}
