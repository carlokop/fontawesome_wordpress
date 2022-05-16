<?php

/**
 * @package  font-awesome-local
 **/

namespace Inc\Modules;

class Deactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }

}
