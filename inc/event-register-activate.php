<?php

/**
 * @package Event_Register
 */

class Event_Register_Activate
{
	public static function activate()
	{
		flush_rewrite_rules();
	}
}
