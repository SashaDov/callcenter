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
}