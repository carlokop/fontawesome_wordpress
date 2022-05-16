<?php

/**
 * @package  font-awesome-local
 **/

namespace Inc\Modules;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }

}
