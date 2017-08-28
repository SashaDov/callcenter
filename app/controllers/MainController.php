<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 27.07.2017
 * Time: 17:11
 */
namespace app\controllers;


use app\models\Main;
use vendor\core\Component;

class MainController extends Controllers {

    public $layout;
    static public $errors = [];
    public $variables = [];

    public function indexPub()
    {
        session_start();
        if (!empty(self::$errors))
        {
            $errors = self::$errors;
            $this->setVariables(compact('errors'));
        }

        if (!empty($_SESSION['login']))
        {
            $login = $_SESSION['login'];
            $model = new Main;
            $check = $model->findOne($login);
            if (empty($check)) {
                $au_fault = "Сотрудника с таким логином более не существует";
                self::$errors[] = $au_fault;
                die;
            }
            $name = $check[0]['full_name'];
            $this->variables['name'] = $name;
            header("Location: http://www.call/call/index");
            exit;
        }
    }

    public function autorizationPub ()
    {
        session_start();
        if ((isset($_POST['login'])) && (isset($_POST['pwd'])))
        {
            $login = $_POST['login'];
            $password = $_POST['pwd'];

            $login = trim(htmlspecialchars(stripslashes($login)));
            $password = trim(htmlspecialchars(stripslashes($password)));

            $model = new Main;
            $query = "SELECT * FROM $model->table WHERE email = :email AND login = :login LIMIT 1";
            $res = $model->findBySql($query, ['email' => $password, 'login' => $login]);

            if (empty($res)) {
                $au_fault = "Извините, введённый вами login или пароль неверный.";
                self::$errors[] = $au_fault;
                header("Location:index");
                die;
            }
            else
            {
                $_SESSION['login'] = $res[0]["login"];
                $_SESSION['name'] = $res[0]['full_name'];
                //$this->variables['name'] = $name;
                header("Location: http://www.call/call/index");
            }
        }
        else
        {
            header("Location: http://www.call/main/index");
        }
    }

    public function loginOutPub ()
    {
        session_start();
        $old_user = $_SESSION['login'];
        unset($_SESSION['login']);
        session_destroy();
        header("Location: http://www.call/main/index");
    }
















}