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
     */
    public function signUp($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));

        if (Validate::checkUserExist($phone)) {
            return $this->error(BAD_REQUEST, USER_EXIST, "This phone already exist");
        }

        if (Functions::sendSMS($phone)) {
            $this->success(OK, [
                'message' => 'Your successfully registered. Please confirm you phone'
            ]);
        }
    }


    public function signUpVerifyPhone()
    {

    }
}