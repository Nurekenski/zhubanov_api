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
    public function updateAvatar($request, $response, $args = [])
    {
        
       
        $is_auth = $request->getAttribute('temp_auth');
        $user_id = $is_auth->unique_id;
        var_dump($this->getParam('password'));
        exit;

       
         if($_FILES['first']) {
            $first_path = new Avatar($_FILES['first']);
            $which = "zagruzit_udastak";
            
            var_dump($first_path->save());
            
            if (!$first_path->checkType() && !$second_path->checkType() && !$third_path->checkType() && !$fourth_path->checkType())
            {
                return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
            }
            else if ($first_path->save() && $second_path->save() && $third_path->save() && $fourth_path->save())
            {
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
            }
            else {
                $new_url = \Models\Avatar::updatePhoto($user_id,$which,$first_path->name);
                if(!$new_url){
                    return $this->error(INTERNAL_SERVER_ERROR, AVATAR_EXIST, "Avatar exist");
                }
                else if ($new_url=="notuploaded"){
                
                    return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded sdasd");
                }
                return $this->success(OK,
                    [
                        'message' => 'Avatar successfully uploaded and updated',
                        'link_first' => ACCOUNT_SERVER . $new_url['first']
                        
                    ]
                );
            }

          
        
         }
         else if ($_FILES['second']) {
            $first_path = new Avatar($_FILES['second']);
            $which = "zagruzit_certificate";
            
            var_dump($first_path->save());
            if (!$first_path->checkType() && !$second_path->checkType() && !$third_path->checkType() && !$fourth_path->checkType())
            {
                return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
            }
            else if ($first_path->save() && $second_path->save() && $third_path->save() && $fourth_path->save())
            {
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
            }
            else {
                $new_url = \Models\Avatar::updatePhoto($user_id,$which,$first_path->name);
                if(!$new_url){
                    return $this->error(INTERNAL_SERVER_ERROR, AVATAR_EXIST, "Avatar exist");
                }
                else if ($new_url=="notuploaded"){
                
                    return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded sdasd");
                }
                return $this->success(OK,
                    [
                        'message' => 'Avatar successfully uploaded and updated',
                        'link_first' => ACCOUNT_SERVER . $new_url['first'],
                        
                    ]
                );
            }
           
         }
         else if ($_FILES['third']){
            $first_path = new Avatar($_FILES['third']);
            $which = "zagruzit_obr";
            
            var_dump($first_path->save());
            if (!$first_path->checkType() && !$second_path->checkType() && !$third_path->checkType() && !$fourth_path->checkType())
            {
                return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
            }
            else if ($first_path->save() && $second_path->save() && $third_path->save() && $fourth_path->save())
            {
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
            }
            else {
                $new_url = \Models\Avatar::updatePhoto($user_id,$which,$first_path->name);
                if(!$new_url){
                    return $this->error(INTERNAL_SERVER_ERROR, AVATAR_EXIST, "Avatar exist");
                }
                else if ($new_url=="notuploaded"){
                
                    return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded sdasd");
                }
                return $this->success(OK,
                    [
                        'message' => 'Avatar successfully uploaded and updated',
                        'link_first' => ACCOUNT_SERVER . $new_url['first'],
                        
                    ]
                );
            }
         }
         else if ($_FILES['fourth']){
            $first_path = new Avatar($_FILES['fourth']);
            $which = "zagruzit_svidetelstva";
            
            var_dump($first_path->save());
            if (!$first_path->checkType() && !$second_path->checkType() && !$third_path->checkType() && !$fourth_path->checkType())
            {
                return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
            }
            else if ($first_path->save() && $second_path->save() && $third_path->save() && $fourth_path->save())
            {
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
            }
            else {
                $new_url = \Models\Avatar::updatePhoto($user_id,$which,$first_path->name);
                if(!$new_url){
                    return $this->error(INTERNAL_SERVER_ERROR, AVATAR_EXIST, "Avatar exist");
                }
                else if ($new_url=="notuploaded"){
                
                    return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded sdasd");
                }
                return $this->success(OK,
                    [
                        'message' => 'Avatar successfully uploaded and updated',
                        'link_first' => ACCOUNT_SERVER . $new_url['first'],
                        
                    ]
                );
            }
         }
 
       
        // $second = $_FILES['second'];
        // $third = $_FILES['third'];
        // $fourth = $_FILES['fourth'];
        
        
        // $first_path = new Avatar($first);
        // $second_path = new Avatar($second);
        // $third_path = new Avatar($third);
        // $fourth_path = new Avatar($fourth);


    }
    public function add($request, $response, $args = [])
    {
        $is_auth = $request->getAttribute('temp_auth');
        $user_id = $is_auth->unique_id;
        
        $first = $_FILES['first'];
        $second = $_FILES['second'];
        $third = $_FILES['third'];
        $fourth = $_FILES['fourth'];
        
        
        $first_path = new Avatar($first);
        $second_path = new Avatar($second);
        $third_path = new Avatar($third);
        $fourth_path = new Avatar($fourth);


        var_dump($first_path->save());
        var_dump($second_path->save());
        var_dump($third_path->save());
        var_dump($fourth_path->save());

        if (!$first_path->checkType() && !$second_path->checkType() && !$third_path->checkType() && !$fourth_path->checkType())
        {
            return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
        }
        else if ($first_path->save() && $second_path->save() && $third_path->save() && $fourth_path->save())
        {
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
        }
        else {
            $new_url = \Models\Avatar::addPhoto($user_id, $first_path->name,$second_path->name,$third_path->name,$fourth_path->name);
        
            if(!$new_url){
                return $this->error(INTERNAL_SERVER_ERROR, AVATAR_EXIST, "Avatar exist");
            }
            else if ($new_url=="notuploaded"){
             
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded sdasd");
            }
            return $this->success(OK,
                [
                    'message' => 'Avatar successfully uploaded',
                    'link_first' => ACCOUNT_SERVER . $new_url['first'],
                    'link_second' => ACCOUNT_SERVER . $new_url['second'],
                    'link_third' => ACCOUNT_SERVER . $new_url['third'],
                    'result'=> ROOT
                ]
            );
        }

       

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
        $is_auth = $request->getAttribute('temp_auth');

        $unique_id = $this->getParam('unique_id');
     
        $avatars = \Models\Avatar::getPhotos($unique_id);

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