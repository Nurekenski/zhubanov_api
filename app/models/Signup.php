<?php

namespace Models;

use Lib\Db;
use Lib\Functions;
use Lib\Logging;
use Lib\Validate;

class Signup
{
    /**
     * @param $phone
     * @return bool|\PDOStatement|string
     * @throws \Exception
     */
    public static function setUserID($phone)
    {
        $user = Validate::checkUserExist($phone);

        try {
            if(!$user) {
                $order = Functions::orderPhoneByCountry($phone);
                $sql = "INSERT INTO users (phone, country_id, status) VALUES(:phone, :country_id, :status)";

                return Db::getInstance()->Query($sql, [
                    'phone' => $phone,
                    'country_id' => $order['id'],
                    'status' => 'activated'
                ]);
            } else {
                return $user['id'];
            }
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }

    public static function setUserData()
    {

    }
}