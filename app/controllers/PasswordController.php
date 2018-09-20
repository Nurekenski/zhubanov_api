<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 11:16
 */

namespace Controllers;


use Lib\Db;
use Lib\Functions;
use Lib\Validate;
use Models\Password;

class PasswordController extends Controller
{
    public function change($request, $response, $args)
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));

        $user = Validate::checkUserExist($phone);

        if(!$user){
            return $this->error(BAD_REQUEST, USER_NOT_EXIST, 'User not exist!');
        }

        if(!Functions::sendSMS($phone)){
            $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");
        }

        $this->success(OK, [
            'message' => 'confirmation code has been sent to you'
        ]);
    }

    public function verifyCode($request, $response, $args)
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));

        $code = $this->getParam('code');

        if(!Functions::checkCode($phone, $code))
            return $this->error(BAD_REQUEST, CODE_ERROR, "Code error");

        $user_id = Validate::checkUserExist($phone)['id'];

        $this->success(OK,
            [
                'message' => 'Your successfully confirmed phone',
                'access_token' => $this->createToken($user_id,
                    [
                        'phone' => $phone,
                        'iss' => 'token.account.tmp'
                    ]
                )
            ]
        );
    }

    public function update()
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));
        $user = Validate::checkUserExist($phone);
        $old_passowrd = $this->getParam('old_password');
        $new_password = $this->getParam('new_password');

        if(!Functions::checkPhoneCodeState($phone)){
            return $this->error(BAD_REQUEST, CODE_ERROR, 'Password change not confirmed');
        }

        if(!password_verify($old_passowrd, $user['password'])){
            $this->error(INVALID_LOGIN_OR_PASSWORD, "Invalid password");
        }

        if(!empty($new_password)){
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        }

        if(!Password::updatePassword($user['id'], $new_password)){
            $this->error(BAD_REQUEST, UNEXPECTED_ERROR, "Passworn not updating");
        }

        $this->success(OK, ['message' => 'New password successfully updated']);


    }
}