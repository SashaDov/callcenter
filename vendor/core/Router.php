<?php
namespace vendor\core;
/**
 * Class Router
 * class reads a query_string, compare with this, find a match by pattern and direct user to a definite route
 *
 */

class Router{

    public static $routes = [];
    public static $route = [];

    /**
     * @param $regex
     * @param array $route
     */
    public static function collectRoutes($regex, $route = [])
    {
        self::$routes[$regex] = $route;
    }

    public  static function getRoutes()
    {
        return self::$routes;
    }


    public  static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param $url
     * @return bool
     */
    protected static function matchRoutes($url)
    {
        foreach(self::$routes as $pattern => $route)
        {
            if(preg_match("#$pattern#i",$url,$matches))
            {
                foreach ($matches as $key => $value)
                {
                    if (is_string($key))
                    {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['act']))
                {
                    $route['act'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['act'] = self::lowerCamelCase($route['act']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::treatmentQueryString($url);
        if (self::matchRoutes($url))
        {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller))
            {
                $controllerObj = new $controller(self::$route);
                $act = self::$route['act'] . 'Pub';
                if (method_exists($controllerObj,$act))
                {
                    $controllerObj->$act();
                    $controllerObj->getView();
                }
                else
                {
                    echo "Метод $controller::$act не существует";
                }
            }
            else
            {
                echo "Контроллер $controller не существует";
            }
        }
        else
        {
            http_response_code('404');
            require_once "1.html";
        }
    }
/*
    protected static function upperCamelCase ($url_controller)
    {
        //jf-gfFF JfGfff example
        $mas_controller = explode('-',$url_controller);
        $new_mas_controller = "";
        foreach ($mas_controller as $value)
        {
            $new_mas_controller[] = ucwords(strtolower($value));
        }
        $url_controller = join($new_mas_controller);
        return $url_controller;
    }
*/
    protected static function upperCamelCase ($url_controller)
    {
        $url_controller = str_replace('-',' ',$url_controller);
        $url_controller = str_replace(' ','', ucwords(strtolower($url_controller)));
        return $url_controller;
    }

    protected static function lowerCamelCase ($url_act)
    {
        $url_act = lcfirst(self::upperCamelCase($url_act));
        return $url_act;
    }

    protected  static  function treatmentQueryString ($query_string)
    {
        if ($query_string)
        {
            $mas_from_qs = explode('&',$query_string);
            if (false === strpos($mas_from_qs[0],'='))
            {
                return rtrim($mas_from_qs[0],'/');
            }
        }
        return '';
    }














}