<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 27.08.2017
 * Time: 20:45
 */

namespace app\controllers;
use app\models\Call;


class CallController extends Controllers
{

    public $layout = 'employee';

    public function indexPub ()
    {
        $this->sessionData();
    }

    public function newClientsPub ()
    {
        $this->sessionData();
        if ((isset($_POST['email'])) && (isset($_POST['fio'])) && (isset($_POST['number'])))
        {
            $fio = trim(htmlspecialchars(stripslashes($_POST['fio'])));
            $email = trim(htmlspecialchars(stripslashes($_POST['email'])));
            $tel = trim(htmlspecialchars(stripslashes($_POST['number'])));

            $model = new Call();
            if ($model->insertPhone($tel) === true)
            {
                if($model->insertCustomer($fio,$email) === true)
                {
                    header("Location: http://www.call/call/index");
                }
            }
            else
            {
                header("Location: http://www.call/call/new-clients");
            }
        }
    }

    public  function newOrderPub ()
    {
        $this->sessionData();
    }

}