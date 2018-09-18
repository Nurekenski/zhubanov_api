<?php

namespace Middleware;

use Firebase\JWT\JWT;

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
        try {
            $auth = $request->getHeader("Authorization");

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
            $response->getBody()->write(json_encode([
                'errcode' => NOT_AUTHORIZED,
                'error' => "Not authorized"
            ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus(UNAUTHORIZED);
        }
    }
}