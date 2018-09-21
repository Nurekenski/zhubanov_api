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
    public static function addPhoto($user_id, $path)
    {
        $full_path = '/images/' . $path;
        $addStatus = Db::getInstance()->Query("INSERT INTO avatars(user_id, path) VALUES(:user_id, :path)",
            [
                'user_id' => $user_id,
                'path' => $full_path
            ]);

        if ($addStatus) return $full_path;
    }


    /**
     * @param $user_id
     * @return array|bool
     * @throws \Exception
     */
    public static function getPhotos($user_id)
    {
        $sql = "SELECT id, path FROM avatars WHERE user_id = :user_id ORDER BY avatars.id DESC";

        $avatars = Db::getInstance()->Select($sql,
            [
                'user_id' => $user_id
            ], true);

        if($avatars) {
            $links = [];
            foreach($avatars as $key => $avatar) {
                $links[$key]['id'] = $avatar['id'];
                $links[$key]['link'] = ACCOUNT_SERVER . $avatar['path'];
            }

            return $links;
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