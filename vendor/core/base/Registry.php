<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 03.08.2017
 * Time: 16:57
 */

namespace vendor\core\base;


class Registry {

    protected static $objects = [];

    protected static $instance;

    protected function __construct()
    {
        require_once ROOT . "/config/config.php";
        foreach ($config['components'] as $object => $way_to_component)
        {
            self::$objects[$object] = new $way_to_component;
        }
    }

    public static function getInstance ()
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __get($object)
    {
        if (is_object(self::$objects[$object]))
        {
            return self::$objects[$object];
        }
    }

    public function __set($object, $way_to_component)
    {
        if (!isset(self::$objects[$object]))
        {
            self::$objects[$object] = new $way_to_component;
        }
    }

    public function getObj ()
    {
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }
}
