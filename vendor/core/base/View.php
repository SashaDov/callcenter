<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 29.07.2017
 * Time: 15:52
 */

namespace vendor\core\base;


class View
{

    /**
     * current route
     * @var array
     */
    public $route = [];

    /**
     * current view
     * @var string
     */
    public $view;

    /**
     * current pattern
     * @var string
     */
    public $layout;

    public function __construct($route, $layout = "", $view)
    {
        $this->route = $route;
        if ($layout === false)
        {
            $this->layout = false;
        }
        else
        {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render ($vars)
    {
        if (is_array($vars))extract($vars);

        $file_view = APP . "/views/" . $this->route['controller'] ."/". $this->view .".php";
        ob_start();
        if (is_file($file_view))
        {
            require_once $file_view;
        }
        else
        {
            echo "не найден вид $file_view";
        }
        $content = ob_get_clean();

        if ($this->layout !== false)
        {
            $file_layout = APP . "/views/layouts/". $this->layout .".php";
            if (is_file($file_layout))
            {
                require_once $file_layout;
            }
            else
            {
                echo "не найден шаблон $file_layout";
            }
        }
        else
        {
            echo $content;
        }
    }

    public function cutScripts ()
    {
        //функция вырезает скрипты из вида, чтобы вставить в рендер выше в шаблоны, считаю глупым,
        // ведь это делается лишь для того, чтобы можно было располагать скрипты подключения джава-библиотек внизу,
        // а то выходит, что контент вида вставляет их выше подключенных библиотек, но ведь проще подключить вверху
    }



















}