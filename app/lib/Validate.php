<?php

namespace Lib;

class Validate
{
    /**
     * @param string $phone
     * @param string $id
     * @return array|bool|mixed
     * @throws \Exception
     */
    public static function checkUserExist($phone = '', $id = '')
    {
        try {
            $db = Db::getInstance();
            $sql = "SELECT * FROM users WHERE phone = :phone OR id = :id";
            $user = $db->Select($sql, [
                'phone' => $phone,
                'id' => $id,
            ]);

            if ($user) return $user;
            return false;
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }

    }

    /**
     * @param $phone
     * @return mixed
     */
    public static function standartizePhone($phone){
        $phone = str_replace([' ', '(', ')', '-', '+'], '', $phone);
        return $phone;
    }
}
