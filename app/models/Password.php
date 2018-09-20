<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 13:12
 */

namespace Models;


use Lib\Db;

class Password
{
    public static function updatePassword($id, $new_password)
    {
        return Db::getInstance()->Query('UPDATE users SET password = :password WHERE id = :id',[
           'id' => $id,
           'password' => $new_password
        ]);
    }
}