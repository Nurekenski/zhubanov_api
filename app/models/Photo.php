<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 16:53
 */

namespace Models;


use Lib\Db;

class Photo
{
    public static function addPhoto($user_id, $path)
    {
        return Db::getInstance()->Query("INSERT INTO avatars(user_id, path) VALUES(:user_id, :path)",
            [
                'user_id' => $user_id,
                'path' => $path
            ]);
    }
}