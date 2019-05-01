<?php

namespace Lib;

use Lib\Logging;

class Avatar
{

    public $image = null;
    public $name = null;
    public $path = null;
    public $type = null;


    public function __construct($image)
    {
        $this->image = $image;
        $this->setType();
        $this->generateName();
    }

    public function save()
    {
        $savePath = ROOT . '/../images/' . $this->name;  // todo вынести в конфиг

        $tmpName = $this->image['tmp_name'];

        if (!move_uploaded_file($tmpName, $savePath)){
            return false;
        }
        return true;
    }


    public static function delete($path)
    {
        if ( (@unlink(ROOT . '/..' . $path)) ) {
            return true;
        }
        return false;
    }

    private function setType() 
    {
        $pic = $this->image['type'];

        switch($pic) {
            case 'image/jpg': $this->type = 'jpg'; return true;
            case 'image/jpeg': $this->type = 'jpeg'; return true;
            case 'image/png': $this->type = 'png'; return true;
            case 'image/gif': $this->type = 'gif'; return true;
        }
        return $this->type;
    }

    function generateName($length = 15) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->name = $randomString . '.' . $this->type;
    }


    public function checkType()
    {
        if (!$this->type){
            return false;
        }
        return true;
    }

}