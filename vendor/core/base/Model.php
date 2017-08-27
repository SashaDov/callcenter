<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 30.07.2017
 * Time: 19:26
 */

namespace vendor\core\base;


use vendor\core\Db;

abstract class Model
{

    protected $pdo;

    /**
     * a table from DB with witch a definite model works
     * @var
     */
    protected $table;

    /**
     * default: to use for determining of table field
     * @var string
     */
    protected $primary_key = "id";

    /**
     * connect with F_filterFromPostKey
     * @var array
     */
    protected $unrestricted_fields_db = [];

    /**
     * make a new class Db of connection to database
     * and afford to use functions of this class without EXTENDing to class Model
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    public function findAll ()
    {
        $sql = "SELECT * FROM ". $this->table;
        return $this->pdo->querySelect($sql);
    }

    public function findOne ($unical_data,$field_table = "")
    {
        $field_table = $field_table ?: $this->primary_key; //any unic field
        $sql = "SELECT * FROM $this->table WHERE $field_table = :". $field_table." LIMIT 1";
        return $this->pdo->querySelect($sql,[$field_table => $unical_data]);
    }

    /**
     * f_findBySql is convienient for any case of SQL-query
     * if $show_result = no, will perform execAdd/Db.php without result::fetchAll
     * @param $sql
     * params: field_table => unical_data
     * @param array $params
     * @return array
     */
    public function findBySql ($sql,$params = [], $show_result = "yes")
    {
        if ($show_result === 'no')
        {
            return $this->pdo->execAdd($sql,$params);
        }
        return $this->pdo->querySelect($sql,$params);
    }

    /**
     * NO TEST!
     * the only admin determines which fields seek in DB from post(get)-user data
     * unrestricted protected - array of admin access fields DB
     * @param $server_mas - array post(get, put...) from user
     * @return array - clear user-array
     * default: POST
     */
    public function filterFromPostKey ($server_mas = [])
    {
        $server_mas = $server_mas ?: $_POST;
        return array_intersect_key($server_mas, array_flip($this->unrestricted_fields_db));
    }

}















