<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 16:16
 */

namespace Controllers;


use Lib\Photo;

class PhotoController extends Controller
{
    public function add()
    {

    }
    public function test($request, $response, $args = [])
    {
        $user_id = 4; // todo getted token
        $photo = $_FILES['photo'];

        $photo = new Photo($photo);
        if(!$photo->checkType()){
            // todo error
        }
        if(!$photo->save()){
            // todo  error
        }
        if(!\Models\Photo::addPhoto($user_id, $photo->name)){
            // todo  error
        }

        return $this->success(OK, ['photo']);

    }
}