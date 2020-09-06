<?php

/**
 * @package Event_Register
 */

class Event_Register_Deactivate
{
	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
