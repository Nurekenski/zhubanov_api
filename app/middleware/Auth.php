<?php

namespace Middleware;

use Firebase\JWT\JWT;
use Lib\Logging;

class Auth
{
    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $auth = $request->getHeader("Authorization");

        try {
            if (preg_match('/Bearer\s(\S+)/', $auth[0], $matches)) {
                $token = $matches[1];
                $payload = JWT::decode($token, JWT_SECRET, ['HS256']);

                if ($payload && is_object($payload)) {
                    $request = $request->withAttribute('auth', $payload);

                    return $next($request, $response);
                } else {
                    $response->getBody()->write(json_encode([
                        'errcode' => NOT_AUTHORIZED,
                        'error' => "Not authorized"
                    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

                    return $response->withStatus(UNAUTHORIZED);
                }
            } else {
                $response->getBody()->write(json_encode([
                    'errcode' => NOT_AUTHORIZED,
                    'error' => "Not authorized"
                ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

                return $response->withStatus(UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            Logging::getInstance()->JWTlog($e, $auth);

            $response->getBody()->write(json_encode([
                'errcode' => NOT_AUTHORIZED,
                'error' => "Not authorized"
            ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus(UNAUTHORIZED);
        }
    }
}