<?php

/**
 * @package EventRegister
 */

 class EventRegisterDeactivate
 {
     public static function deactivate()
     {
        flush_rewrite_rules();
     }
 }
 