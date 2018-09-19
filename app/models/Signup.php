<?php

namespace Models;

use Lib\Db;
use Lib\Psql;
use Lib\Functions;
use Lib\Logging;
use Lib\Validate;

class Signup
{
    /**
     * @param $phone
     * @return bool|\PDOStatement|string
     * @throws \Exception
     */
    public static function setUserID($phone)
    {
        $user = Validate::checkUserExist($phone);

        try {
            if(!$user) {
                $order = Functions::orderPhoneByCountry($phone);
                $sql = "INSERT INTO users (phone, country_id, status) VALUES(:phone, :country_id, :status)";

                return Db::getInstance()->Query($sql, [
                    'phone' => $phone,
                    'country_id' => $order['id'],
                    'status' => 'activated'
                ]);
            } else {
                return $user['id'];
            }
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }


    /**
     * @param $user_id
     * @param $password
     * @param $name
     * @param $lastname
     * @param $birthday
     * @param $gender
     * @param null $inviter_id
     * @return bool|\PDOStatement|string
     */
    public static function setUserData($user_id, $password, $name, $lastname, $birthday, $gender, $inviter_id = null)
    {
        $sql = "UPDATE users SET password = :password, name = :name, lastname = :lastname, birthday = :birthday, gender = :gender 
                WHERE id = :id";

        $newUser = Db::getInstance()->Query($sql,
            [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name' => $name,
                'lastname' => $lastname,
                'birthday' => $birthday,
                'gender' => $gender,
                'id' => $user_id
            ]
        );

        if($newUser) {
            if($inviter_id) {
                $json = json_encode([
                    "inviter_id" => $inviter_id
                ]);
                $sql = "INSERT INTO registration_data(user_id, json) VALUES(:user_id, :json)";
                $reg_data = Db::getInstance()->Query($sql,
                    [
                        'user_id' => $user_id,
                        'json' => $json
                    ]
                );
            }
            return $newUser;
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @param $password
     * @param $phone
     * @param $name
     * @param $lastname
     * @return bool
     * @throws \Exception
     */
    public static function regInMatrix($user_id, $password, $phone, $name, $lastname)
    {
        try {
            $url = MATRIX_SERVER . '/_matrix/client/r0/register';
            $matrixRegister= [
                'username' => 'id' . $user_id,
                'password' => $password,
                'auth' => [
                    'type' => 'm.login.dummy'
                ]

            ];

            $result = Functions::postQuery($url, $matrixRegister);
            if ($result['error']) return false;

            $m_user_id = '@' . $matrixRegister['username'] .':api.msg.otau.org';
            $medium = 'msisdn';
            $address = $phone;
            $validated_at = time();
            $added_at = time();

            $query = "INSERT INTO user_threepids(user_id, medium, address, validated_at, added_at) 
            VALUES('$m_user_id', '$medium', '$address', '$validated_at', '$added_at')";
            $matrixAddPhone = Psql::get()->connect()->Query($query);

            $user_id_profiles = $matrixRegister['username'];
            $nick = $name . ' ' . $lastname;
            $matrixDb = Psql::get()->connect()->Query("UPDATE profiles SET displayname = '$nick'
                                    WHERE user_id = '$user_id_profiles'");
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }
}