<?php

namespace Controllers;

use Models\User;

class UserController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function get($request, $response, $args = [])
    {
        $is_auth = $request->getAttribute('is_auth');

        $userData = User::getUserData($is_auth->user_id, $is_auth->phone, $this->createToken($is_auth->user_id));

        return $userData ? $this->success(OK, $userData)
            : $this->error(UNAUTHORIZED, NOT_AUTHORIZED, "Not authorized");
    }

    /**
     * @param $request
     * @param $response
     * @param array $args
     */
    public function edit($request, $response, $args = [])
    {

    }
}