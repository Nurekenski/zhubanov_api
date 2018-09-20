<?php

namespace Models;

use Lib\Db;
use Lib\Functions;
use Lib\Logging;


class User
{
    /**
     * @param $user_id
     * @param $phone
     * @return array|bool|mixed
     * @throws \Exception
     */
    public static function getUserData($user_id, $phone, $network_token)
    {
        try {
            $sql = "SELECT phone, name, lastname, birthday, gender, avatars.path AS avatar, 
                country, region, city,
                email, nickname, address, postcode
                FROM users
                LEFT JOIN countries ON countries.id = users.country_id
                LEFT JOIN regions ON regions.id = users.region_id
                LEFT JOIN cities ON cities.id = users.city_id

                LEFT JOIN avatars ON avatars.user_id = users.id
                WHERE users.id = :id AND users.phone = :phone
                ORDER BY avatars.id DESC";

            $user = Db::getInstance()->Select($sql,
                [
                    'id' => $user_id,
                    'phone' => $phone
                ]
            );
            if ($user) {
                if($user['avatar']) {
                    $user['avatar'] = ACCOUNT_SERVER . $user['avatar'];
                } else {
                    $user['avatar'] = null;
                }

                $headers = [
                    'Authorization: Bearer ' . $network_token,
                    'Content-Type: application/json'
                ];
                $coins = Functions::postQuery(NETWORK_SERVER . '/balance', [], $headers);

                if ($coins['balance'] === null) {
                    $user['balance'] = null;
                } else {
                    $user['balance'] = round($coins['balance'], 2, PHP_ROUND_HALF_DOWN);
                }

                return $user;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }
}