<?php

namespace Controllers;

use Models\Signup;
use Lib\Validate;
use Lib\Functions;

class SignupController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function signUp($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));

        $user = Validate::checkUserExist($phone);
        if($user['password']) {
            return $this->error(BAD_REQUEST, USER_EXIST, "Phone exist");
        }

        return Functions::sendSMS($phone) ? $this->success(OK,
            [
                'message' => 'Your successfully registered. Please confirm you phone'
            ]
        ) : $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");
    }


    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function signUpVerifyPhone($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));
        $code = $this->getParam('code');

        if (Functions::checkCode($phone, $code)) {
            $user_id = Signup::setUserID($phone);

            if($user_id) {
                return $this->success(OK,
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
        } else {
            return $this->error(BAD_REQUEST, CODE_ERROR, "Code error");
        }
    }


    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function signUpData($request, $response, $args = [])
    {
        $temp_auth= $request->getAttribute('temp_auth');

        $password = $this->getParam('password');
        $name = $this->getParam('name');
        $lastname = $this->getParam('lastname');
        $birthday = $this->getParam('birthday');
        $gender = $this->getParam('gender');
        $inviter_id = $this->getParam('inviter_id');

        if($gender != 'male' && $gender != 'female') {
            return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "gender should be: male or female");
        }

        $user = Validate::checkUserExist('', $temp_auth->user_id);
        if($user['password'] == !null) {
            return $this->error(BAD_REQUEST, USER_ERROR, "You have already set a password when registering");
        }

        $newUser = Signup::setUserData($temp_auth->user_id, $password, $name, $lastname, $birthday, $gender, $inviter_id);

        if ($newUser) {
            #Signup::regInMatrix($temp_auth->user_id, $password, $temp_auth->phone, $name, $lastname); // TODO: update server
            // TODO: Matrix
            return $this->success(OK,
                [
                    'message' => 'Data successfully saved. Your ID: ' . $temp_auth->user_id
                ]
            );
        } else {
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error");
        }
    }
}