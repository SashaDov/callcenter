<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 03.08.2017
 * Time: 16:59
 */

namespace vendor\core;


use vendor\core\base\Registry;

/**
 * Class Component
 * inherit from Registry class
 * @package vendor\core
 */
class Component
{

    public static $component;

    public function __construct()
    {
        self::$component = Registry::getInstance();
    }
}