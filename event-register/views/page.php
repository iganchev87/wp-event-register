<?php

/**
 * Display event information.
 */
$event_date     = esc_html(get_post_meta(get_the_ID(), 'event_date', true));
$event_location = esc_html(get_post_meta(get_the_ID(), 'event_location', true));
$event_url      = esc_html(get_post_meta(get_the_ID(), 'event_url', true));
$gFormated_date = gmdate('Ymd\THis', strtotime($event_date)) . 'Z';
$calendarData = [
	'text' => esc_html(get_the_title()),
	'date' => $gFormated_date,
	'dates' => $gFormated_date . '/' . $gFormated_date,
	'location' => esc_html($event_location),
	'timeZone', 
];
?>
<div class="sel-event-container">
	<p>
		<b>Event date:</b> <?php echo $event_date; ?></p>
	<p>
		<b>Event location:</b> <?php echo $event_location; ?></p>
	<p>
		<b>Event URL:</b> <a href="<?php echo $event_url; ?>" target="_blank" rel="nofollow">Click here</a>
	</p>
	<p>
		<a href="http://www.google.com/calendar/render?action=TEMPLATE&<?php echo http_build_query($calendarData); ?>" target="_blank" rel="nofollow">Add to my google calendar</a>
	</p>
</div>
<div class="googleMap">
	<?php
		include_once 'views/components/google-map.php';
	?>
</div>