<?php

namespace App\Components;

use Throwable;

class IPStack
{
    const BASE_URL = 'http://api.ipstack.com/';

    private static $loadedData = [];

    /**
     * @param string $ip
     * @return mixed
     */
    public static function getContinent(string $ip)
    {
        if (!array_key_exists($ip, self::$loadedData)) {
            self::loadIpInfo($ip);
        }
        return self::$loadedData[$ip];
    }

    /**
     * @param string $ip
     * @return void
     */
    private static function loadIpInfo(string $ip)
    {
        try {
            $response = file_get_contents(self::BASE_URL . $ip . '?access_key=' . config('ipStackKey'));
            $array = json_decode($response, true);
            if (isset($array['success']) && $array['success'] === false) {
                $error = 'Failed to retrieve data for IP address ' . strip_tags($ip);
                if (!empty($array['error']['info'])) {
                    $error .= '. Reason: ' . $array['error']['info'];
                }
                Errors::add($error);
            }
            self::$loadedData[$ip] = $array['continent_code'] ?? null;
        } catch (Throwable $e) {
            self::$loadedData[$ip] = null;
        }
    }
}