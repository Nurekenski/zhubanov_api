<?php

namespace Lib;

class Validate
{
    /**
     * @param string $phone
     * @param string $id
     * @return array|bool|mixed
     * @throws \Exception
     */
    public static function checkUserExist($phone = '')
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM users WHERE phone = :phone";
        
        $user = $db->Select($sql,
            [
                'phone' => $phone
            ]
        );

        if ($user) return $user;
        return false;
    }

    public static function checkUser($iin) {

        $db = Db::getInstance();
        $sql = "SELECT * FROM student_registration WHERE iin = :iin";
        
        $user = $db->Select($sql,
            [
                'iin' => $iin
            ]
        );
      
        if ($user) return $user;
        return false;
    }  
    
    public static function checkUser_($iin) {

        $db = Db::getInstance();
        $sql = "SELECT * FROM student_table WHERE iin = :iin";
        
        $user = $db->Select($sql,
            [
                'iin' => $iin
            ]
        );
      
        if ($user) return $user;
        return false;
    }  
    public static function checkUserExist2($phone = '')
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM sms WHERE phone = :phone";
        
        $user = $db->Select($sql,
            [
                'phone' => $phone
            ]
        );

      
        if ($user) return $user;
        return false;
    }



    /**
     * @param $phone
     * @return mixed
     */
    public static function standartizePhone($phone){
        $phone = str_replace([' ', '(', ')', '-', '+'], '', $phone);
        return $phone;
    }
}
