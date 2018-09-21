<?php

namespace Models;

use Lib\Functions;
use Lib\Validate;
use Lib\Logging;

class Login
{
    /**
     * @param $phone
     * @param $password
     * @return array|bool|mixed
     */
    public static function authExec($phone, $password)
    {
        $user = Validate::checkUserExist($phone);
        if (password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }


    /**
     * @param $phone
     * @param $password
     * @return bool|mixed
     */
    public static function authExecMatrix($phone, $password)
    {
        $url = MATRIX_SERVER . '/_matrix/client/r0/login';
        $curl_data = [
            'type' => 'm.login.password',
            'password' => $password,
            'identifier' => [
                'type' => 'm.id.phone',
                'country' => 'KZ',
                'number' => $phone
            ]
        ];

        $auth = Functions::postQuery($url, $curl_data);

        if ($auth['error']) return false;
        return $auth;
    }
}