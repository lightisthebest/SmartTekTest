<?php

const DS = DIRECTORY_SEPARATOR;
const APP_DIR = __DIR__ . DS . 'app';
$appFile = APP_DIR . DS . 'App.php';
if (!file_exists($appFile)) {
    throw new Exception('Application file is not found');
}
require_once $appFile;

$composerAutoload = __DIR__ . DS . 'vendor' . DS . 'autoload.php';
if (!file_exists($composerAutoload)) {
    throw new Exception('Autoloader is not found');
}
require_once $composerAutoload;

\App\App::run();