<?php

namespace Controllers;

use Lib\Avatar;


class AvatarController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     */
    public function add($request, $response, $args = [])
    {
        $is_auth = $request->getAttribute('is_auth');
        $user_id = $is_auth->user_id;

        $photo = $_FILES['avatar'];

        $photo = new Avatar($photo);
        if (!$photo->checkType()){
            return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
        }
        if (!$photo->save()){
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
        }
        $new_url = \Models\Avatar::addPhoto($user_id, $photo->name);
        if(!$new_url){
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
        }

        return $this->success(OK,
            [
                'message' => 'Avatar successfully uploaded',
                'link' => ACCOUNT_SERVER . $new_url
            ]
        );

    }


    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function get($request, $response, $args = [])
    {
        $is_auth = $request->getAttribute('is_auth');

        $avatars = \Models\Avatar::getPhotos($is_auth->user_id);

        if (!$avatars)
            return $this->error(OK, AVATAR_ERROR, "Avatars not found");

        return $this->success(OK, $avatars);
    }

    public function delete($request, $response, $args = [])
    {
        $is_auth = $request->getAttribute('is_auth');

        $photo_id = $this->getParam('photo_id');

        $delete = \Models\Avatar::deletePhoto($photo_id, $is_auth->user_id);

        if (!$delete)
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not deleted");

        Avatar::delete($delete['old_path']);

        return $this->success(OK,
            [
                "message" => "Photo successfully deleted",
                "link" => $delete['new_url']
            ]
        );
    }
}