<?php

namespace App\Controllers;

abstract class Controller implements ControllerInterface
{
    protected $view;
    /**
     * @param string $view
     * @param array $params
     */
    protected function render(string $view, array $params = [])
    {
        $this->view = APP_DIR . DS . 'Views' . DS . $view . '.php';
        if (file_exists($this->view)) {
            extract($params);
            require_once $this->view;
        } else {
            echo 'Requested file is not found';
        }
    }
}