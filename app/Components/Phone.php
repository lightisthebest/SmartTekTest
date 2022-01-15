<?php

namespace App\Components;

use Exception;

class Phone
{
    private static $loadedData = [];
    private static $countries = [];

    /**
     * @param string $phone
     * @return mixed
     * @throws Exception
     */
    public static function getContinent(string $phone)
    {
        if (!array_key_exists($phone, self::$loadedData)) {
            self::loadInfo($phone);
        }
        return self::$loadedData[$phone];
    }

    /**
     * @param string $phone
     * @return void
     * @throws Exception
     */
    private static function loadInfo(string $phone)
    {
        if (empty(self::$countries)) {
            self::$countries = config('phones');
        }
        foreach (self::$countries as $country) {
            $start = $country['phone'];
            if (strpos($phone, $start) === 0) {
                self::$loadedData[$phone] = $country['continent'];
                return;
            }
        }
        self::$loadedData[$phone] = '';
    }
}