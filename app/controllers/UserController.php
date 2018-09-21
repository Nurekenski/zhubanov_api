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
        $is_auth = $request->getAttribute('is_auth');

        $body = $request->getParsedBody();

        if(!is_array($body)) {
            $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "Enter the parameters");
            return $response->withStatus(400);
        }


        if($body['gender']) {
            if($body['gender'] !== 'male' && $body['gender'] !== 'female') {
                return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "gender should be: male or female");
            }
        }
        if ($body['email'] && !filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "email is not valid");
        }

        $rows = '';
        foreach($body as $key => $value) {
            if($key == 'name'       ||
                $key == 'lastname'   ||
                $key == 'birthday'   ||
                $key == 'gender'     ||
                $key == 'email'      ||
                $key == 'nickname'   ||
                $key == 'country_id' ||
                $key == 'region'  ||
                $key == 'city'    ||
                $key == 'address'    ||
                $key == 'postcode'
            ) {
                $rows .= $key . ' = :' . $key . ', ';
                $queryBody[$key] = $value;
            } else {
                return $this->error(BAD_REQUEST, NO_VALIDATE_PARAMETER, "Only parameters: name, lastname, birthday, gender, email, nickname, country_id, region, city, address, postcode");
            }
        }
        $rows = trim($rows, ', ');

        if (!User::editUserData($is_auth->user_id, $rows, $queryBody))
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Data not edited");

        return $this->success(OK, ['message' => 'Data successfully saved']);
    }
}