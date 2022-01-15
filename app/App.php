<?php

namespace App;

use App\Controllers\ApiController;
use App\Controllers\ControllerInterface;
use App\Controllers\DefaultController;

class App
{
    const API_LINK = '/api';

    const CONTROLLERS_MAP = [
        self::API_LINK => ApiController::class
    ];

    public static function run()
    {
        $instance = new static();
        $controller = $instance->createController();
        $controller->run();
    }

    /**
     * @return ControllerInterface
     */
    private function createController(): ControllerInterface
    {
        $path = $_SERVER['PATH_INFO'] ?? null;
        $controllerClass = self::CONTROLLERS_MAP[$path] ?? DefaultController::class;

        $classIsController = class_exists($controllerClass)
            && in_array(ControllerInterface::class, class_implements($controllerClass));

        if ($classIsController) {
            return new $controllerClass;
        }
        return new DefaultController();
    }
}