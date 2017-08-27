<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 03.08.2017
 * Time: 10:52
 */

namespace vendor\libs;


class Cache
{

    public function __construct()
    {
        //в случае назначения прав для юникс систем Обязательно!!! папке temp надо будет назначить права на добавление
    }

    public function getCache ($key_object)
    {
        $file = CACHE . '/' .md5($key_object) . '.txt';
        if (file_exists($file))
        {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['time_stop_cache'])
            {
                return $content['data_file'];
            }
            unlink($file);
        }
        return false;
    }

    public function setCache ($key_object,$data_file,$caching_time = 3600)
    {
        $file = CACHE . '/' .md5($key_object) .'.txt';
        $content['data_file'] = $data_file;
        $content['time_stop_cache'] = time() + $caching_time;
        if (file_put_contents($file,serialize($content))) return true;
        return false;
    }

    public function deleteFileCache ($key_object)
    {
        $file = CACHE . '/' .md5($key_object) . '.txt';
        if (file_exists($file))
        {
            unlink($file);
        }
        return false;
    }
}
















