<?php

namespace Controllers;

use Models\Login;
use Lib\Validate;
use Monolog\Handler\LogglyHandler;

class LoginController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     */
    public function signIn($request, $response, $args = [])
    {
        // $phone = Validate::standartizePhone($this->getParam('phone'));
        $phone = $this->getParam('phone');
        $password = $this->getParam('password');

        $user = Login::authExec($phone, $password);
        #$userMatrix = Login::authExecMatrix($phone, $password); // TODO: вынести в UPDATE server
        // TODO: Matrix
        return $user ? $this->success(OK,
            [
                'user_id' => $user['id'],
                'access_token' => $this->createToken($user['id'],
                    [
                        'phone' => $user['phone'],
                        'password' => $user['password']
                    ]
                ),
              
            ]
        ) : $this->error(UNAUTHORIZED, INVALID_PHONE_OR_PASSWORD, "Invalid phone or password");
    }
}