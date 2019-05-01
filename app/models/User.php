<?php

namespace Models;

use Lib\Db;
use Lib\Functions;
use Lib\Logging;


class User
{
    /**
     * @param $user_id
     * @param $phone
     * @return array|bool|mixed
     * @throws \Exception
     */
    public static function getUserData($user_id, $email, $network_token)
    {
        $sql = "SELECT username, name, surname, email, password,phone from users_table where id='$user_id'";

        $user = Db::getInstance()->Select($sql,
            [
                'id' => $user_id,
                'email' => $email
            ]
        );
        return $user;
        // if ($user) {
        //     if($user['avatar']) {
        //         $user['avatar'] = ACCOUNT_SERVER . $user['avatar'];
        //     } else {
        //         $user['avatar'] = null;
        //     }

        //     $headers = [
        //         'Authorization: Bearer ' . $network_token,
        //         'Content-Type: application/json'
        //     ];
        //     $coins = Functions::postQuery(NETWORK_SERVER . '/balance', [], $headers);

        //     if ($coins['balance'] === null) {
        //         $user['balance'] = null;
        //     } else {
        //         $user['balance'] = round($coins['balance'], 2, PHP_ROUND_HALF_DOWN);
        //     }

        //     return $user;
        // } else {
        //     return false;
        // }
    }

    /**
     * @param $query
     * @param $queryBody
     */
    public static function editUserData($user_id, $rows, $queryBody)
    {
        $sql = 'UPDATE users SET ' . $rows . ' WHERE id = :id';

        $queryBody['id'] = $user_id;
        $user = Db::getInstance()->Query($sql,
            $queryBody
        );

        if ($user) return true;
        return false;

    }

}