<?php

namespace Lib;

class Validate
{
    /**
     * @param string $phone
     * @param string $id
     * @return array|bool|mixed
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

    /**
     * @param $phone
     * @return array|bool|mixed
     */
    public static function checkPhone($phone){
        try {
            $four = substr($phone, 0, 4);
            $three = substr($phone, 0, 3);
            $two = substr($phone, 0, 2);
            $one = substr($phone, 0, 1);

            $sql = "SELECT * FROM countries WHERE 
                        code = :four OR 
                        code = :three OR 
                        code = :two OR 
                        code = :one ORDER BY code DESC LIMIT 1";
            $country = Db::getInstance()->Select($sql, [
                'four' => $four,
                'three' => $three,
                'two' => $two,
                'one' => $one
            ]);

            $country['standart_phone'] = $phone;
            if ($country)
                return $country;
            return false;
        } catch (\PDOException $e) {

        }
    }
}
