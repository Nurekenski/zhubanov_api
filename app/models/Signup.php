<?php

namespace Models;

use Lib\Db;
use Lib\Psql;
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
        $user = Validate::checkUserExist2($phone);

        if($user) {
            // $order = Functions::orderPhoneByCountry($phone);
            $sql = "INSERT INTO users(phone, status) VALUES(:phone, :status)";
            
            return Db::getInstance()->Query($sql, [
                'phone' => $phone,
                // 'country_id' => $order['id'],
                'status' => 'activated'
            ]);
        } else {
            return $user['id'];
        }
    }

    public static function set_password($temp_auth,$password)
    {
        $data = Db::getInstance()->Query('UPDATE users SET password = :password WHERE id = :id',
        [
            'id' => $temp_auth->user_id,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        if($data){
            return true;
        }
        else {
            return false;
        }
    
    }

    /**
     * @param $user_id
     * @param $password
     * @param $name
     * @param $lastname
     * @param $birthday
     * @param $gender
     * @param null $inviter_id
     * @return bool|\PDOStatement|string
     */
    public static function setUserData($surname,$name,$third_name,$photo,$temp_auth)
    {
        $data = Db::getInstance()->Query('UPDATE users SET surname = :surname,name = :name, third_name =:third_name,
        photo=:photo WHERE id = :id',
        [
            'id' => $temp_auth->user_id,
            'surname' => $surname,
            'name' => $name,
            'third_name' => $third_name,
            'photo' => $photo
        ]);

        if($data){
            return true;
        }
        else {
            return false;
        }
    }


}