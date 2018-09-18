<?php

namespace Lib;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Logging
{
    private static $_instance = null;

    private function __construct ()
    {
        $this->_instance = new Logger('LOG');
    }

    private function __clone () {}
    private function __wakeup () {}

    public static function getInstance()
    {
        if (self::$_instance != null) {
            return self::$_instance;
        }
        return new self;
    }

    /**
     * @param $e
     * @throws \Exception
     */
    public function db($e)
    {
        $this->_instance->pushHandler(new StreamHandler(ROOT . '/../logs/database.log'));
        $this->_instance->error($e->getMessage(),
            [
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'trace' => $e->getTrace(),
                'line' => $e->getLine()
            ]
        );
    }


    /**
     * @param $e
     * @throws Exception
     */
    public function err($e)
    {
        $this->_instance->pushHandler(new StreamHandler(ROOT . '/../logs/errors.log'));
        $this->_instance->error($e->getMessage(),
            [
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'trace' => $e->getTrace(),
                'line' => $e->getLine()
            ]
        );
    }


    public function JWTlog($e, $auth = [])
    {
        $this->_instance->pushHandler(new StreamHandler(ROOT . '/../logs/JWT.log'));
        $this->_instance->error($e->getMessage(), $auth);
    }
}


