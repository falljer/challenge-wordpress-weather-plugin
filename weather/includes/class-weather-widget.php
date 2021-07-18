<?php

/**
 * Widget to display weather data
 *
 * @package    JF_Weather_Plugin
 * @subpackage JF_Weather_Plugin/includes
 * @author     Jeremy Fall <falljer@gmail.com>
 */
class JF_Weather_Widget extends WP_Widget {
	public $ajax_url = '/wp-admin/admin-ajax.php?action=get_weather';

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'jf_weather_widget', // Base ID
			'Weather Widget', // Name
			array( 'description' => __( 'A Weather Widget' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$displayed_title = ( ! empty($title) ) ? $before_title . $title . $after_title : '';
		$ajax_url = $this->ajax_url;

		require_once plugin_dir_path( __FILE__ ) . '../public/partials/weather-widget-display.php';
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}