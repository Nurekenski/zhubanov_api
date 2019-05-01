<?php

namespace Models;

use Lib\Db;
use Lib\Logging;

class Avatar
{
    /**
     * @param $user_id
     * @param $path
     * @return string
     * @throws \Exception
     */
    public static function updatePhoto($user_id,$which,$path)
    {
        $first = '/images/' . $path;

        $paths = [
            'first' => $first
        ];
        
        $update_avatar = Db::getInstance()->Query('UPDATE avatars SET  '.$which.'=:'.$which.'  WHERE user_id =:user_id',
        [
             $which =>  $first,
            'user_id' => $user_id
        ]); 

       
        $update_table = Db::getInstance()->Query('UPDATE student_registration SET  '.$which.'=:'.$which.'  WHERE unique_id =:unique_id',
        [
            $which => $first,
            'unique_id' => $user_id
        ]); 

        if($update_avatar && $update_table) {
            return $paths;
        }
    
    }
    public static function addPhoto($user_id,$first,$second,$third,$fourth)
    {
        $first = '/images/' . $first;
        $second = '/images/' . $second;
        $third = '/images/' . $third;
        $fourth = '/images/' . $fourth;
 
        $paths = [
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'fourth' => $fourth
        ];
 
        $sql = "SELECT * FROM avatars WHERE user_id = :user_id";
                
        $checkExist = Db::getInstance()->Select($sql,
            [
                'user_id' => $user_id
            ], 
        false);

            
        if(!$checkExist) {
            $addStatus = Db::getInstance()->Query("INSERT INTO avatars(user_id, zagruzit_udastak,zagruzit_certificate,zagruzit_svidetelstva,zagruzit_obr) VALUES(:user_id, :zagruzit_udastak,:zagruzit_certificate,:zagruzit_svidetelstva,:zagruzit_obr)",
                [
                    'user_id' => $user_id,
                    'zagruzit_udastak' => $first,
                    'zagruzit_certificate' => $second,
                    'zagruzit_svidetelstva'=> $third,
                    'zagruzit_obr' => $fourth
                ]
            );

            $update = Db::getInstance()->Query('UPDATE student_registration SET zagruzit_udastak=:zagruzit_udastak, zagruzit_obr=:zagruzit_obr,zagruzit_svidetelstva=:zagruzit_svidetelstva,zagruzit_certificate=:zagruzit_certificate WHERE unique_id =:unique_id',
                [
                    'zagruzit_udastak' => ACCOUNT_SERVER . $first,
                    'zagruzit_obr' => ACCOUNT_SERVER . $second,
                    'zagruzit_certificate' => ACCOUNT_SERVER . $third,
                    'zagruzit_svidetelstva' => ACCOUNT_SERVER . $fourth,
                    'unique_id' => $user_id
                ]
            );

            if($addStatus && $update) {
                return $paths;
            }
            else {
                return "notuploaded";
            }
        }
        else {
            return false; 
        }
     
    }


    /**
     * @param $user_id
     * @return array|bool
     * @throws \Exception
    */

    public static function getPhotos($user_id)
    {
        $sql = "SELECT id, zagruzit_udastak,zagruzit_certificate,zagruzit_svidetelstva,zagruzit_obr FROM avatars WHERE user_id = :user_id ORDER BY avatars.id DESC";

        
        $avatars = Db::getInstance()->Select($sql,
            [
                'user_id' => $user_id
            ], false);

        if($avatars) {
            $links = [];
            // foreach($avatars as $key => $avatar) {
                $links['id'] = $avatars['id'];
                $links['first_path'] = ACCOUNT_SERVER . $avatars['zagruzit_udastak'];
                $links['second_path'] = ACCOUNT_SERVER . $avatars['zagruzit_certificate'];
                $links['third_path'] = ACCOUNT_SERVER . $avatars['zagruzit_obr'];
                $links['fourth_path'] = ACCOUNT_SERVER . $avatars['zagruzit_svidetelstva'];
            // }

            return $links;
            // return  $avatar['path'];
        }
        return false;
    }


    /**
     * @param $photo_id
     * @param $user_id
     * @return bool
     */
    public static function deletePhoto($photo_id, $user_id)
    {
        $sql = "SELECT * FROM avatars WHERE id = :id AND user_id = :user_id";
        $photo = Db::getInstance()->Select($sql,
            [
                'id' => $photo_id,
                'user_id' => $user_id
            ]
        );

        if ($photo) {
            $sql = "DELETE FROM avatars WHERE id = :id AND user_id = :user_id";
            $deleteExec = Db::getInstance()->Query($sql,
                [
                    'id' => $photo_id,
                    'user_id' => $user_id
                ]
            );

            if ($deleteExec) {
                $sql = "SELECT id, path FROM avatars WHERE user_id = :user_id ORDER BY avatars.id DESC LIMIT 1";
                $last_avatar = Db::getInstance()->Select($sql,
                    [
                        'user_id' => $user_id
                    ]
                );

                $new_url = ACCOUNT_SERVER . $last_avatar['path'];

                if ($new_url == ACCOUNT_SERVER) $new_url = null;

                $success = [
                    'new_url' => $new_url,
                    'old_path' => $photo['path']
                ];

                return $success;

            }
            return false;
        }
        return false;
    }
}