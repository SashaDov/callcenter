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

    public function testPub ()
    {
        session_start();
        if (isset($_SESSION['login']))
        {
            $name = $_SESSION['name'];
            $this->layout = 'employee';
            //dd($this->variables);
            $this->setVariables(compact('name'));

        }


        //$this->view = "index";
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

//$this->layout = "default";
    // $this->layout = false; //отключить шаблон вовсе, чтобы вывести на экран просто тех инфу, например
    //$this->view = "test";
    //Component::$component->getObj();
    // echo __CLASS__ . ' ';
    //echo __METHOD__ . 'информация из индекс акта контроллера мэйн';

    //$name = "Петя";
    //$message = 'good morning';

    //$model = new Main;
    //$field1 = "thema";
    //$field3 = "published_data";
    //$f1 = "five thema";
    //$f3 = "12-04-17 22:14:09";
    //$sql = "INSERT posts ($field1, $field3) VALUES (:$field1, :$field3)";
    //$res = $model->findBySql($sql,[$field1 => $f1,$field3 => $f3],'no');
    //var_dump($res);

    //$sql = "SELECT * FROM $model->table WHERE $field1 LIKE :$field1 AND $field3=:$field3";

    //$res = $model->findBySql($sql,[$field1 => $f1,$field3 => $f3]); //$field1 => 'second article',
    //debug($res);

    //$articles = Component::$component->cache->getCache('articles');
    //var_dump($articles); //cache

    //if (!$articles)
    //{
    //$articles = $model->findAll();
    //  Component::$component->cache->setCache('articles',$articles);
    //}
    //$this->setVariables(compact('articles'));
    //var_dump(Component::$component->cache->deleteFileCache('articles'));
    //echo date('d-m-Y H:i', time()) . " " . date('d-m-Y H:i', 1501862868);
    //debug($articles);

    //$article = $model->findOne('second article');
    //debug($article);















}