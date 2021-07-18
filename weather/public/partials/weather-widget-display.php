<?php
/**
 * These variables are available for this view:
 *
 * @var string $before_widget
 * @var string $displayed_title
 * @var string $after_widget
 * @var string $ajax_url
 *
 */ ?>
<?php echo $before_widget; ?>
<?php echo $displayed_title ?>
<div class="jf_weather_widget">
	<div id="jf_weather_current">
		...
	</div>
	<div id="jf_weather_info">
		<div id="jf_weather_temp"></div>
		<div id="jf_weather_high_low"></div>
	</div>
</div>
<div id="jf_weather_alerts"></div>
<?php echo $after_widget; ?>

<script type="application/javascript">
	window.ajaxurl = "<?php echo $ajax_url; ?>";
	jQuery(document).ready(function($) {
		$.getJSON(ajaxurl).then(function(data) {

			// Temperature
			$('#jf_weather_temp')
				.html(data.current.temp + '&deg;F');
			$('#jf_weather_high_low')
				.html('H: ' + data.daily[0].temp.max + '&deg;&nbsp;&nbsp;L: ' + data.daily[0].temp.min + '&deg;');

			// Weather icon
			if(data.current.weather.length > 0) {
                let img = $('<img />')
                    .attr('src', 'http://openweathermap.org/img/wn/' + data.current.weather[0].icon + '@2x.png');
                $('#jf_weather_current')
					.html('')
					.append(img);
            } else {
			    $('#jf_weather_current').html('Error');
			}

			// Alerts
            $('#jf_weather_alerts').html('');
			if(data.alerts.length > 0) {
			    data.alerts.forEach(function(alert) {
			        let alertDiv = $('<div />')
				        .attr('style', 'background: red; color: white; padding: 6px;')
				        .html('<b>' + alert.event + '</b>');
                    $('#jf_weather_alerts').append(alertDiv);
			    });
			}
		});
	});
</script>
