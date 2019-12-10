<?php

namespace Models;

use Lib\Db;
use Lib\Logging;

class Api
{
    /**
     * @param $user_id
     * @param $path
     * @return string
     * @throws \Exception
     */
    public static function insert($name,$email,$comment)
    {

        $sql = "INSERT INTO comments(name,email,comments) 
        VALUES(:name,:email,:comments)";

        $neworder = Db::getInstance()->Query($sql,
            [
                'name' => $name,
                'email' => $email,
                'comments' => $comment
            ]
        );

        $get = "SELECT * FROM comments";

        $getcomment = Db::getInstance()->Select_($get,
            [
        
            ], 
        true); 

        if($getcomment) {
            return json_encode($getcomment,JSON_UNESCAPED_UNICODE);
        }
        else {
            return false;
        }
    }

    public static function get()
    {
        $get = "SELECT * FROM comments";

        $getcomment = Db::getInstance()->Select_($get,
            [
        
            ], 
        true); 

        if($getcomment) {
            return json_encode($getcomment,JSON_UNESCAPED_UNICODE);
        }
        else {
            return false;
        }
    }


}