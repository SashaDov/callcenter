<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 30.07.2017
 * Time: 19:26
 */

namespace vendor\core;


class Db
{

    /**
     * keep connection object PDO from config/config_db_pdo.php
     * @var $config array
     */
    protected $pdo;

    /**
     * SINGLETON pattern - keep __construct of connection to database
     * in order not to connect every time
     * @var object
     */
    protected static $instance;

    /**
     * quantity of all sql queries
     * @var int
     */
    public static $countSql = 0;

    public static $queriesAll = [];

    protected function __construct()
    {
        $config = require_once ROOT . '/config/config_db_pdo.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($config['dsn'],$config['user'],$config['password'],$options);
    }

    public static function getInstance ()
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * f_execAdd with prepare: delete, insert one, update, create
     */
    public function execAdd ($sql, $params = [])
    {
        self::$countSql++;
        self::$queriesAll[] = $sql;
        $statement = $this->pdo->prepare($sql);
        if (!empty($params))
        {
            foreach ($params as $field_table => $value_table)
            {
                $statement->bindValue(':'.$field_table,$value_table);
            }
        }
        return $statement->execute();
    }

    /**
     * f_querySelect with prepare: select
     * @param $sql
     * bindParam ипользуется по ссылке,
     * если передаем большой объем информации или если после бинда ,но перед экзек хотим изменить переменную
     */
    public function querySelect ($sql,$params = [])
    {
        //debug($params);
        self::$countSql++;
        self::$queriesAll[] = $sql;
        $statement = $this->pdo->prepare($sql);
        if (!empty($params))
        {
            foreach ($params as $field_table => $value_table)
            {
                $statement->bindValue(':'.$field_table,$value_table);
            }
        }
        $result = $statement->execute();
        if ($result !== false)
        {
            return $statement->fetchAll();
        }
        return [];
    }





}












