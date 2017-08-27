<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 28.07.2017
 * Time: 14:50
 */

namespace vendor\core\base;


abstract class Controller
{

    public $route = [];

    public $view;

    /**
     * current pattern
     * @var string
     */
    public $layout;

    /**
     * variables from users
     * @var array
     */
    public $variables = [];

    public function __construct($mas_route)
    {
        $this->route = $mas_route;
        $this->view = $mas_route['act'];

    }

    public function getView ()
    {
        $viewObj = new View($this->route,$this->layout,$this->view);
        $viewObj->render($this->variables);
    }

    /**
     * F_set collect variables from users /=>render()/
     * @param $vars
     */
    public function setVariables ($vars)
    {
        $this->variables = $vars;
    }

    public function is_ajax ()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
    }















}