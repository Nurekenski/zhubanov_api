<?php

namespace Controllers;

use \Interop\Container\ContainerInterface as ContainerInterface;

use Firebase\JWT\JWT;

abstract class Controller
{
    protected $ci;

    protected $request;
    protected $response;


    /**
     * Controller constructor.
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
        $this->request = $ci['request'];
        $this->response = $ci['response'];
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
     * @param $user_id
     * @param string $phone
     * @param string $password
     * @return string
     */
    public function createToken($user_id, $phone = '', $password = '')
    {
        $exp_time = $password ? time() + EXP_TIME : time() + 60 * 60;

        $payload = [
            'iat' => time(),
            'iss' => ISSUE,
            'exp' => $exp_time,
            'user_id' => $user_id
        ];

        if ($phone) $payload['phone'] = $phone;
        if ($password) $payload['password'] = $password;

        return JWT::encode($payload, JWT_SECRET, "HS256");
    }
}