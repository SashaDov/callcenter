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
                    if ($model->insertOrder() === true)
                    {
                        if (isset($_SESSION['email_customer']))
                        {
                            unset($_SESSION['email_customer']);
                        }
                        $_SESSION['email_customer'] = $email;
                        header("Location: http://www.call/call/new-order");
                    }
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
        session_start();
        if (isset($_SESSION['login']))
        {
            $name = $_SESSION['name'];
            $model = new Call;
            if (isset($_SESSION['email_customer'])) {
                $email = $_SESSION['email_customer'];
                $data_customer = $model->getOrdersFromOneCustomer($email);
                $this->setVariables(compact('data_customer', 'name'));
            }
            if (isset($_SESSION['tel_customer'])) {
                $tel = $_SESSION['tel_customer'];
                $data_customer = $model->findCustomerByPhone($tel);
                $this->setVariables(compact('data_customer', 'name'));
            }
        }
    }

    public function oldClientsPub ()
    {
        $this->sessionData();
        $model = new Call();

        if (isset($_POST['email']))
        {
            $email = trim(htmlspecialchars(stripslashes($_POST['email'])));
            if (isset($_SESSION['email_customer']))
            {
                unset($_SESSION['email_customer']);
            }
            $_SESSION['email_customer'] = $email;
            header("Location: http://www.call/call/new-order");
        }

        if (isset($_POST['fio']))
        {
            $fio = trim(htmlspecialchars(stripslashes($_POST['fio'])));

        }

        if (isset($_POST['number']))
        {
            $tel = trim(htmlspecialchars(stripslashes($_POST['number'])));
            if (isset($_SESSION['email_customer']))
            {
                unset($_SESSION['email_customer']);
            }
            $_SESSION['tel_customer'] = $tel;
            header("Location: http://www.call/call/new-order");
        }
    }

    public function changeStatusPub ()
    {
        $this->view = 'newOrder';
        session_start();
        if (isset($_SESSION['login']))
        {
            $name = $_SESSION['name'];
            $model = new Call;
            if ((isset($_GET['id'])) && (isset($_GET['client'])) && (isset($_GET['status']))) {
                $id = $_GET['id'];
                $client = $_GET['client'];
                $status = $_GET['status'];
                $model->changeStatusOrder($id, $status);
                $data_customer = $model->findCustomerByIdClient($client);
                $this->setVariables(compact('data_customer', 'name'));
            }
        }

    }

}