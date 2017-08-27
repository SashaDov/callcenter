<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 30.07.2017
 * Time: 19:28
 */

namespace app\models;


use vendor\core\base\Model;

class Main extends Model
{

    //table with witch the model Main works
    public $table = 'posts';

    //overdetermining of property "primary key"
    public $primary_key = "thema";

    //only 'thema' in DB could be changed by user
    public $unrestricted_fields_db = ['thema'];
}