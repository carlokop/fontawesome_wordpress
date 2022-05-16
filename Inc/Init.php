<?php
/**
 * This class handles abstraction and autoloading / auto initializing
 * You can auto load / auto init any class by filling it into the get_services array
 * 
 * @package  font-awesome-local
 **/

namespace Inc;

final class Init
{
    //return array with all the classNames that need to be autoloaded
    public static function get_services()
    {
        return [
            \Modules\Enqueue_Plugin::class,
            \Modules\Settings::class,
        ];
    }

    //This method is called to initialise
    //This methid inits autoloading and loops trough tough the get_services array and instantiates each class
    public static function register_services()
    {
        spl_autoload_register('self::my_autoloader');

        foreach (self::get_services() as $class) {
            $className = __NAMESPACE__ . '\\' . $class;
            $instance = new $className();
        }
    }

    //autoload
    public static function my_autoloader($class) {

        $class = str_replace('\\', '/', $class);
        $class = str_replace('Inc/', '', $class);

        if (file_exists(__DIR__ . DS . $class . '.php')) {
            require_once __DIR__ . DS . $class . '.php';
        }

    }

}
