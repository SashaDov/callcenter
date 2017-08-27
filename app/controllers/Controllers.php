<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 30.07.2017
 * Time: 12:16
 */

namespace app\controllers;


use vendor\core\base\Controller;

/**
 * Class Controllers
 * base for all controllers for definite site
 *
 * @package app\controllers
 *
 */
class Controllers extends Controller
{

    protected function sessionData ()
    {
        session_start();
        if (isset($_SESSION['login']))
        {
            $name = $_SESSION['name'];
            $this->setVariables(compact('name'));
            return true;
        }
        else
        {
            header("Location: http://www.call/main/index");
            exit;
        }

    }
}