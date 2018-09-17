<?php

namespace Middleware;

use Lib\Db;
use Lib\Functions;

class SpamControl
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        try {
            $sql = 'SELECT * FROM sms WHERE ip = :ip ORDER BY id DESC LIMIT 1';
            $block = Db::getInstance()->Select($sql, [
                'ip' => Functions::getClientIP()
            ]);

            $created_at = strtotime($block['created_at']);
            $time = time() - $created_at;

            if ($time <= 60) {
                $errors = [
                    "errcode" => USER_LIMIT,
                    "error" => "Stop spamming. Wait 1 min"
                ];

                $response->getBody()->write(json_encode($errors, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                return $response->withStatus(BAD_REQUEST);
            }

            return $next($request, $response);

        } catch (\PDOException $e) {

        }
    }
}