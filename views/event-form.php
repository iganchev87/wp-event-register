<?php
// event-register form
?>
<div class="g_calendar_container">
	<div class="event-input-wrapper">
		<label for="event_date">Event date:</label>
		<input id="event_date" name="event_date" type="text" placeholder="2020-12-31" required value="<?php echo esc_textarea($event_date); ?>" 
			class="regular-text ev_datepicker g_calendar">
	</div>
	<div class="event-input-wrapper">
		<label for="event_location">Event location:</label>
		<textarea id="event_location" name="event_location" type="text" placeholder="Add something to remind" class="regular-text g_location">
				<?php echo esc_textarea($event_location); ?>
		</textarea>
	</div>
	<div class="event-input-wrapper">
		<label for="event_url">Event URL:</label>
		<input id="event_url" name="event_url" type="url" placeholder="https://devrix.com" size="30" required 
			value="<?php echo esc_textarea($event_url); ?>" class="regular-text">
	</div>
	<div class="event-input-wrapper">
		<a class="gCalendarLink" target="_blank" href="#">add to google calaendar</a>
	</div>
</div>
<?php
	include_once 'components/google-map.php';
?>