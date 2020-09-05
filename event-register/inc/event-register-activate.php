<?php

/**
 * @package EventRegister
 */

 class EventRegisterActivate
 {
     public static function activate()
     {
        flush_rewrite_rules();
     }
 }
 