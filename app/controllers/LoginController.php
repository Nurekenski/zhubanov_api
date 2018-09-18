<?php

namespace Controllers;

use Models\Login;
use Lib\Validate;

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
        $phone = Validate::standartizePhone($this->getParam('phone'));
        $password = $this->getParam('password');

        $user = Login::authExec($phone, $password);
        $userMatrix = Login::authExecMatrix($phone, $password);

        return $user && $userMatrix ? $this->success(OK, [
            'user_id' => $user['id'],
            'token' => $this->createToken($user['id'], $user['phone'], $user['password']),
            'msg_token' => $userMatrix['access_token']
        ]) : $this->error(UNAUTHORIZED, INVALID_LOGIN_OR_PASSWORD, "Invalid phone or password");
    }
}