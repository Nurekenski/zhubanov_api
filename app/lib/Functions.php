<?php

namespace Lib;

class Functions
{
    /**
     * @param $url
     * @param $curl_data
     * @return mixed
     */
    public static function postQuery($url, $curl_data, $decode = true)
    {
        $options = [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => json_encode($curl_data)
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        curl_close($ch);

        if ($decode) return json_decode($content, true);
        return $content;
    }


    /**
     * @param $phone
     * @param $country_id
     */
    public static function sendSMS($phone, $country_id = 68)
    {
        try {
            $sql = "INSERT INTO sms(code, phone, ip, status, country_id) VALUES(:code, :phone, :ip, :status, :country_id)";
            $code = mt_rand(10000, 99999);

            $db = Db::getInstance()->Query($sql, [
                'code' => $code,
                'phone' => $phone,
                'ip' => self::getClientIP(),
                'status' => 'new',
                'country_id' => $country_id
            ]);

            if ($db) {
                if (getenv('SMS_API_KEY') && APP_ENV == 'production') {
                    $startTime = microtime(true);
                    $api = new MobizonApi(getenv('SMS_API_KEY'), 'api.mobizon.kz');
                    $api->call('message',
                        'sendSMSMessage',
                        array(
                            'recipient' => $phone,
                            'text' => 'Код подтверждения OTAU: ' . $code,
                        ));
                    // $endTime = microtime(true) - $startTime;
                }
                return $db;
            }

            return false;
        } catch (\PDOException $e) {

        }
    }


    /**
     * @return array|false|string
     */
    public static function getClientIP()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

}