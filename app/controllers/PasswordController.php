<?php

namespace Controllers;

use Lib\Db;
use Lib\Functions;
use Lib\Validate;
use Models\Password;

class PasswordController extends Controller
{
    public function forgot($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));

        $user = Validate::checkUserExist($phone);

        if(!$user && $user['password'] == null){
            return $this->error(BAD_REQUEST, USER_NOT_EXIST, 'Phone not exist');
        }

        if(!Functions::sendSMS($phone)){
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");
        }

        return $this->success(OK,
            [
                'message' => 'Please confirm the phone'
            ]
        );
    }

    
    public function verifyCode($request, $response, $args)
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));
        $code = $this->getParam('code');

        if(!Functions::checkCode($phone, $code))
            return $this->error(BAD_REQUEST, CODE_ERROR, "Code error");

        $user = Validate::checkUserExist($phone);

        return $this->success(OK,
            [
                'message' => 'Your successfully confirmed phone',
                'access_token' => $this->createToken($user['id'],
                    [
                        'phone' => $user['phone'],
                        'password' => $user['password']
                    ]
                )
            ]
        );
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function update($request, $response, $args)
    {
        $is_auth = $request->getAttribute('is_auth');

        $type = $this->getParam('type');
        $user = Validate::checkUserExist($is_auth->phone, $is_auth->user_id);

        if ($type == 'forgot') {
            $new_password = $this->getParam('new_password');

            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            if(!Password::updatePassword($user['id'], $password_hash)){
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Password not updated");
            }

            return $this->success(OK, ['message' => 'New password successfully updated']);

        } elseif ($type == 'change') {
            $old_password = $this->getParam('old_password');
            $new_password = $this->getParam('new_password');

            if(!$old_password){
                return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "old_password must not be empty");
            }
            if(!password_verify($old_password, $user['password'])){
                return $this->error(BAD_REQUEST, INVALID_PHONE_OR_PASSWORD, "Invalid password");
            }

            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            if(!Password::updatePassword($user['id'], $password_hash)){
                return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Password not updated");
            }

            return $this->success(OK,
                [
                    'message' => 'New password successfully updated',
                    'access_token' => $this->createToken($is_auth->user_id,
                        [
                            'phone' => $is_auth->phone,
                            'password' => $password_hash
                        ]
                    )
                ]);
        } else {
            return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "type should be: forgot or change");
        }
    }
}