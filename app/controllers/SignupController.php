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
                        'access_token' => $this->createToken($user_id)
                    ]
                );
            }
        } else {
            return $this->error(BAD_REQUEST, CODE_ERROR, "Code error");
        }
    }
}