<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2>Weather Settings</h2>
	<?php settings_errors(); ?>
    <form method="POST" action="options.php">
		<?php
		settings_fields( 'jf_weather_general_settings' );
		do_settings_sections( 'jf_weather_general_settings' );
		?>
		<?php submit_button(); ?>
    </form>
</div>
