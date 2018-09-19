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
    public static function getUserData($user_id, $phone)
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
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MzczODA2OTIsImlzcyI6ImFjY291bnQub3RhdS5vcmciLCJleHAiOjE1Mzk5NzI2OTIsInVzZXJfaWQiOiIyIiwicGhvbmUiOiI3Nzc3MzY5NzQxNyIsInBhc3N3b3JkIjoiJDJ5JDEwJGwyTnE4Yk1iTlJiVU01Qndad3lMaGViOTg2blVVQ1wvenJjM0cydGdReDd3ek5tR0NjWjhkaSJ9.WUnYdqVTwTGjHYBc_XtdKI78p-u4ccf57TGqEuLimrU',
                    'Content-Type: application/json'
                ];
                $coins = Functions::postQuery(NETWORK_SERVER . '/balance', [], $headers);
                pe($coins);
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