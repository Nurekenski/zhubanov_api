<?php

namespace Controllers;

use Firebase\JWT\JWT;

abstract class Controller
{
    protected $request;
    protected $response;
    protected $args;

    /**
     * @param $request
     * @param $response
     * @param array $args
     */
    public function setQuery($request, $response, $args = [])
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }


    /**
     * @param $param
     * @return mixed
     */
    public function getParam($param)
    {
        return $this->request->getParam($param);
    }


    /**
     * @param $status - html status
     * @param $errcode - error code
     * @param $error - error message
     * @return mixed
     */
    public function error($status, $errcode, $error)
    {
        $array = [
            "errcode" => $errcode,
            "error" => $error
        ];
        $this->response->getBody()->write(json_encode($array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        return $responseError = $this->response->withStatus($status);
    }


    /**
     * @param $status - html status
     * @param $array - data
     * @return mixed
     */
    public function success($status, $array)
    {
        $this->response->getBody()->write(json_encode($array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        return $responseSuccess = $this->response->withStatus($status);
    }


    /**
     * @param $id
     * @param string $phone
     * @param string $password
     * @return string
     */
    public function createToken($id, $phone = '', $password = '')
    {
        $payload = [
            'iat' => time(),
            'iss' => ISSUE,
            'exp' => time() + EXP_TIME,
            'id' => $id
        ];

        if ($phone) $payload['phone'] = $phone;
        if ($password) $payload['password'] = $password;

        return JWT::encode($payload, JWT_SECRET, "HS256");
    }
}