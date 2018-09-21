<?php

namespace Models;

use Lib\Db;
use Lib\Logging;
use Lib\Psql;

class Password
{
    /**
     * @param $user_id
     * @param $new_password
     * @return bool|\PDOStatement|string
     * @throws \Exception
     */
    public static function updatePassword($user_id, $new_password)
    {
//        if (!self::updatePasswordMatrix($user_id, $new_password))
//            return false;
        // TODO: Matrix

        return Db::getInstance()->Query('UPDATE users SET password = :password WHERE id = :id',
            [
                'id' => $user_id,
                'password' => $new_password
            ]
        );
    }

    /**
     * @param $user_id
     * @param $new_password
     */
    public function updatePasswordMatrix($user_id, $new_password) {
        $name = "@id" . $user_id . ":api.msg.otau.org";
        $matrixDb = Psql::get()->connect()->Query("UPDATE users SET password_hash = '". password_hash($new_password, PASSWORD_DEFAULT) .
            "' WHERE name = '$name'");

        if ($matrixDb) return true;

        return false;
    }
}