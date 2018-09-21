<?php

namespace Models;
use Lib\Db;


class Network
{
    /**
     * @param $user_id
     */
    public static function getDataForNetwork($phone)
    {
        $sql = "SELECT users.id, name, lastname, birthday, gender, status, json FROM users 
                    LEFT JOIN registration_data ON registration_data.user_id = users.id
                    WHERE phone = :phone
                    ";
        $user = Db::getInstance()->Select($sql, [
            'phone' => $phone
        ]);

        $reg_data = json_decode($user['json'], true);
        if ($user) {
            return [
                "status" => "active",
                "user_id" => $user['id'],
                "verify_code" => mt_rand(10000, 99999),
                "inviter_id" => $reg_data['inviter_id'],
                'user_first_name' => $user['name'],
                'user_last_name' => $user['lastname'],
                'user_birthday' => $user['birthday'],
                'user_sex' => $user['gender']
            ];
        }

        return false;
    }
}