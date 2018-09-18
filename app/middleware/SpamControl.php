<?php

namespace Middleware;

use Lib\Db;
use Lib\Functions;
use Lib\Logging;

class SpamControl
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
        try {
            $sql = 'SELECT * FROM sms WHERE ip = :ip ORDER BY id DESC LIMIT 1';
            $block = Db::getInstance()->Select($sql, [
                'ip' => Functions::getClientIP()
            ]);

            $created_at = strtotime($block['created_at']);
            $time = time() - $created_at;

            if (APP_ENV && $time <= 60) {
                $errors = [
                    "errcode" => USER_LIMIT,
                    "error" => "To resend SMS, wait 1 min"
                ];

                $response->getBody()->write(json_encode($errors, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                return $response->withStatus(BAD_REQUEST);
            }

            return $next($request, $response);

        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }
}