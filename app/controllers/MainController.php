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

    public $layout = 'main';

    public function indexPub()
    {
        $this->layout = "default";
       // $this->layout = false; //отключить шаблон вовсе, чтобы вывести на экран просто тех инфу, например
        $this->view = "test";
        //Component::$component->getObj();
       // echo __CLASS__ . ' ';
        //echo __METHOD__ . 'информация из индекс акта контроллера мэйн';

        //$name = "Петя";
        //$message = 'good morning';

        $model = new Main;
        $field1 = "thema";
        $field3 = "published_data";
        $f1 = "five thema";
        $f3 = "12-04-17 22:14:09";
        //$sql = "INSERT posts ($field1, $field3) VALUES (:$field1, :$field3)";
        //$res = $model->findBySql($sql,[$field1 => $f1,$field3 => $f3],'no');
        //var_dump($res);

        //$sql = "SELECT * FROM $model->table WHERE $field1 LIKE :$field1 AND $field3=:$field3";

        //$res = $model->findBySql($sql,[$field1 => $f1,$field3 => $f3]); //$field1 => 'second article',
        //debug($res);

        $articles = Component::$component->cache->getCache('articles');
        //var_dump($articles); //cache

        if (!$articles)
        {
            $articles = $model->findAll();
            Component::$component->cache->setCache('articles',$articles);
        }
        $this->setVariables(compact('articles'));
        //var_dump(Component::$component->cache->deleteFileCache('articles'));
        //echo date('d-m-Y H:i', time()) . " " . date('d-m-Y H:i', 1501862868);
        //debug($articles);

        //$article = $model->findOne('second article');
        //debug($article);

    }

    public function testPub ()
    {
        if ($this->is_ajax())
        {
            echo "111";
            die;
        }

        $this->layout = FALSE;
        $this->view = "index";
    }

















}