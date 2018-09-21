<?php

namespace Controllers;
use Firebase\JWT\JWT;
use Lib\Db;

class TestController extends Controller
{
    public function encodeToken($request, $response, $args = [])
    {
        $jwt_secret = $this->getParam('jwt_secret');
        $payload = $this->getParam('payload');
        
        $payload['iat'] = time();
        $payload['iss'] = 'test.token.for.7.day';
        $payload['exp'] = time() + 7 * 24 * 60 * 60;

        $token = JWT::encode($payload, $jwt_secret, "HS256");
        pe($token);
    }

    public function testSMS()
    {
        $sms = Db::getInstance()->Select("SELECT id, phone, code, created_at FROM sms WHERE status = 'new' ORDER BY created_at DESC", [], true);
        print_r($sms);

    }
}