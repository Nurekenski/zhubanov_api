<?php

namespace Lib;

class Psql
{
    private static $conn;

    public function connect()
    {
        $pdo = new \PDO("pgsql:dbname=synapse;host=" . PG_HOST . ";port=". PG_PORT, 'postgres', 'secret123123',
            [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
        return $pdo;
    }

    public static function get()
    {
        if (null === static::$conn) {
            static::$conn = new static();
        }

        return static::$conn;
    }

    public function Query($sql, $params = [])
    {
        $res = $this->conn->prepare($sql);
        $res->execute($params);
        return $res;
    }


    protected function __construct() {}
    private function __clone() {}
    private function __wakeup() {   }

}