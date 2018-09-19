<?php

namespace Middleware\JWT;

use Firebase\JWT\JWT;
use Lib\Logging;
use Lib\Db;


class SimpleAuth
{
    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($request, $response, $next)
    {
        $token = $request->getParam('access_token');

        try {
            $payload = JWT::decode($token, JWT_SECRET, ['HS256']);

            if (is_object($payload) && $payload->iss == ISSUE) {
                $user = Db::getInstance()->Select('SELECT id FROM users WHERE id = :id AND phone = :phone AND password = :password',
                    [
                        'id' => $payload->user_id,
                        'phone' => $payload->phone,
                        'password' => $payload->password
                    ]
                );
                if ($user) {
                    $request = $request->withAttribute('is_auth', $payload);
                    return $next($request, $response);
                } else {
                    $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not authorized"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                    return $response->withStatus(UNAUTHORIZED);
                }
            } else {
                $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not authorized"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                return $response->withStatus(UNAUTHORIZED);
            }
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);

            $response->getBody()->write(json_encode(['errcode' => UNEXPECTED_ERROR, 'error' => "Server database error"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus(INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            Logging::getInstance()->JWTlog($e, [$token]);

            $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not authorized"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            return $response->withStatus(UNAUTHORIZED);
        }
    }
}