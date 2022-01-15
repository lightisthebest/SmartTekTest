<?php

namespace App\Controllers;

class DefaultController extends Controller
{
    public function run()
    {
        $this->render('index');
    }
}