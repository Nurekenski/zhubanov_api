<?php

namespace Lib;

class Functions
{
    /**
     * @param $url
     * @param array $curl_data
     * @param array $headers
     * @param bool $decode
     * @return mixed
     */
    public static function postQuery($url, $curl_data = [], $headers = [], $decode = true)
    {
        $options = [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_POST            => 1,
            CURLOPT_HTTPHEADER      => $headers,
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
     * @return array|bool|mixed
     * @throws \Exception
     */
    public static function orderPhoneByCountry($phone){
        try {
            $four = substr($phone, 0, 4);
            $three = substr($phone, 0, 3);
            $two = substr($phone, 0, 2);
            $one = substr($phone, 0, 1);

            $sql = "SELECT * FROM countries WHERE 
                        code = :four OR 
                        code = :three OR 
                        code = :two OR 
                        code = :one ORDER BY code DESC LIMIT 1";
            $country = Db::getInstance()->Select($sql,
                [
                    'four' => $four,
                    'three' => $three,
                    'two' => $two,
                    'one' => $one
                ]
            );

            if ($country) {
                $country['phone'] = $phone;
                return $country;
            }

            return false;
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }

    /**
     * @param $phone
     * @param int $country_id
     * @return bool|\PDOStatement|string
     * @throws \Exception
     */
    public static function sendSMS($phone)
    {
        $order = self::orderPhoneByCountry($phone);

        try {
            $sql = "INSERT INTO sms(code, phone, ip, status, country_id) VALUES(:code, :phone, :ip, :status, :country_id)";
            $code = mt_rand(10000, 99999);

            $db = Db::getInstance()->Query($sql,
                [
                'code' => $code,
                'phone' => $phone,
                'ip' => self::getClientIP(),
                'status' => 'new',
                'country_id' => $order['id']
                ]
            );

            if ($db) {
                if (getenv('SMS_API_KEY') && APP_ENV == 'production') {
                    $api = new MobizonApi(getenv('SMS_API_KEY'), 'api.mobizon.kz');
                    $api->call('message',
                        'sendSMSMessage',
                        array(
                            'recipient' => $phone,
                            'text' => 'Код подтверждения OTAU: ' . $code,
                        ));
                }
                return $db;
            }

            return false;
        } catch (\PDOException $e) {
            Logging::getInstance()->db($e);
        } catch (\Exception $e) {
            Logging::getInstance()->err($e);
        }
    }


    /**
     * @param $phone
     * @param $code
     * @return array|bool|mixed
     */
    public static function checkCode($phone, $code)
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM sms WHERE phone = :phone AND code = :code AND status = :status";
        $checkStatus = $db->Select($sql,
            [
                'phone' => $phone,
                'code' => $code,
                'status' => 'new'
            ]
        );

        if ($checkStatus) {
            $sql = "UPDATE sms SET status = :status WHERE phone = :phone AND code = :code";
            $used = $db->Query($sql, [
                'status' => 'used',
                'phone' => $phone,
                'code' => $code
            ]);

            $created_at = strtotime($checkStatus['created_at']);
            $time = time() - $created_at;

            return $used && $time <= 60 * 5 ? true : false; // 5 min check
        }
        return false;
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