<?php

namespace Middleware\JWT;

use Firebase\JWT\JWT;
use Lib\Logging;
use Lib\Db;


class JobAuth
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
        $token = $request->getParam('access_t');
        try {
            $payload = JWT::decode($token, JWT_SECRET, ['HS256']);
            dd($payload);
            if (is_object($payload) && $payload->iss == ISSUE) {
                $job = Db::getInstance()->Select('SELECT id FROM create_job WHERE id = :id AND job_direction = :job_direction AND job_id = :job_id',
                    [
                        'id' => $payload->user_id,
                        'job_direction' => $payload->job_direction,
                        'job_id' => $payload->job_id
                    ]
                );
                if ($job) {
                    $request = $request->withAttribute('is_job', $payload);
                    return $next($request, $response);
                } else {
                    $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not founded job 1"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                    return $response->withStatus(UNAUTHORIZED);
                }
            } else {
                $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not founded job 2"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                return $response->withStatus(UNAUTHORIZED);
            }
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);

            $response->getBody()->write(json_encode(['errcode' => UNEXPECTED_ERROR, 'error' => "Server database error"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus(INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {

            Logging::getInstance()->JWTlog($e, [$token]);

            $response->getBody()->write(json_encode(['errcode' => NOT_AUTHORIZED, 'error' => "Not authorized www"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            return $response->withStatus(UNAUTHORIZED);
        }
    }
}