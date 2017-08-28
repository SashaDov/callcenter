<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 27.08.2017
 * Time: 23:36
 */

namespace app\models;


use vendor\core\base\Model;

class Call extends Model
{
    public $table;

    public $primary_key;

    public $unrestricted_fields_db;

    public $arr_status = [
        'Забронирован',
        'Оплачен',
        'Сформирован',
        'Отправлен',
        'Получен',
    ];

    public function insertPhone ($tel)
    {
        $sql = "INSERT INTO phone (number) VALUES (:number)";
        return $this->findBySql($sql,['number' => $tel],'no');
    }

    public function insertCustomer ($fio,$email)
    {
        $sql = "INSERT INTO customer (full_name,phone_id,email) VALUES (:full_name,LAST_INSERT_ID(),:email)";
        return $this->findBySql($sql,['full_name' => $fio,'email' => $email],'no');
    }

    public function insertOrder ()
    {
        $sql = "INSERT INTO orders (customer_id) VALUES (LAST_INSERT_ID())";
        return $this->findBySql($sql,[],'no');
    }

    public function getOrdersFromOneCustomer ($email)
    {
        $sql = "select customer.id as id, customer.full_name as name, orders.id as orders, orders.status as status from customer RIGHT JOIN orders ON customer.id = orders.customer_id WHERE customer.email = :email";
        return $this->findBySql($sql,['email' => $email]);
    }

    public function findCustomerByPhone ($tel)
    {
        $sql = "select customer.id as id, customer.full_name as name, orders.id as orders, orders.status as status from customer RIGHT JOIN orders ON customer.id = orders.customer_id WHERE customer.phone_id = (SELECT id from phone WHERE phone.number = :number)";

        return $this->findBySql($sql,['number' => $tel]);
    }

    public function changeStatusOrder ($id,$status)
    {
        foreach ($this->arr_status as $key => $statuses)
        {
            if ($status == $statuses)
            {
                $key_next = $key + 1;
                $changing_status = $this->arr_status[$key_next];
            }
        }
        $sql = "update orders set status='$changing_status' where id = :id";
        return $this->findBySql($sql,['id' => $id],'no');
    }

    public function findCustomerByIdClient ($client)
    {
        $sql = "select customer.id as id, customer.full_name as name, orders.id as orders, orders.status as status from customer RIGHT JOIN orders ON customer.id = orders.customer_id WHERE customer.id = :id";

        return $this->findBySql($sql,['id' => $client]);
    }
}



















