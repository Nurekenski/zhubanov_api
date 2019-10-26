<?php

namespace Lib;

class Db
{
    private static $_instance = null;

    private function __construct ()
    {

        $db_cfg = require ROOT . '/config/db_cfg.php';

        $this->_instance = new \PDO(
            'mysql:host=' . $db_cfg['db_host'] . ';dbname=' . $db_cfg['db_name'],
            $db_cfg['db_user'],
            $db_cfg['db_password'],
            [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'", // установить кодировку
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // возвращать ассоциативные массивы
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION // возвращать Exception в случае ошибки
            ]
        );
    }

    // запрещаем клонирование
    private function __clone () {}
    private function __wakeup () {}

    // получаем ссылку
    public static function getInstance()
    {
        if (self::$_instance != null) {
            return self::$_instance;
        }
        return new self;
    }

    // простой запрос
    public function Query($query, $params = [])
    {
        $res = $this->_instance->prepare($query);

        $res->execute($params);
        if($this->_instance->lastInsertId())
            return $this->_instance->lastInsertId();
        return $res;
    }


    public function searchQuery($query,$params = [])
    {
        $res = $this->_instance->prepare($query);

        $res->execute($params);

        // if($this->_instance->lastInsertId())
        //     return $this->_instance->lastInsertId();
        return $res;

    }

    public function Select_($query, $params = [], $all = true)
    {
        $result = $this->searchQuery($query, $params);
      
        if ($result) {
            if($all)
                return $result->fetchAll();
            return $result->fetch();
        }
    }
    // запрос на выборку
    
    public function Select($query, $params = [],$all)
    {
        $result = $this->Query($query, $params);
       
        if ($result) {
            if($all)
                return $result->fetchAll();
            return $result->fetch();
        }
    }

}
