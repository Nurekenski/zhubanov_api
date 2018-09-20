<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 15:52
 */

namespace Lib;


class Photo
{
    public $image = null;
    public $name = null;
    public $path = null;
    public $type = null;


    public function __construct($image)
    {
        $this->image = $image;
        $this->setType($image);
        $this->generateName();
    }

    public function save()
    {
        $savePath = __DIR__ . '/../../public/images/' . $this->name;  // todo вынести в конфиг
        $tmpName = $this->image['tmp_name'];
        if(!move_uploaded_file($tmpName, $savePath)){
            return false;
        }
        return true;
    }

    private function setType($file) {
        $pic = $file['type'];
        switch($pic) {
            case 'image/jpeg': $this->type = 'jpg'; break;
            case 'image/png': $this->type = 'png'; break;
            case 'image/gif': $this->type = 'gif'; break;
        }
    }

    function generateName($length = 10) {
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
        if(!$this->type){
            return false;
        }
        return true;
    }

}