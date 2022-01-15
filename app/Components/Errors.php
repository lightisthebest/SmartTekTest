<?php

namespace App\Components;

class Errors
{
    protected static $errors = [];

    /**
     * @param $error
     * @return void
     */
    public static function add($error)
    {
        if (is_string($error)) {
            static::$errors[] = $error;
        } elseif (is_array($error)) {
            static::$errors = array_merge(static::$errors, $error);
        }
    }

    /**
     * @param bool $asString
     * @return array|string
     */
    public static function get(bool $asString = false)
    {
        return $asString ? join("<br>", static::$errors) : static::$errors;
    }
}