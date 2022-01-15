<?php
function config($name, $default = null) {
    static $config;
    if (!$config) {
        $config = require APP_DIR . DS . 'config' . DS . 'main.php';
        if (!is_array($config)) {
            $config = [];
        }
    }
    return array_key_exists($name, $config) ? $config[$name] : $default;
}