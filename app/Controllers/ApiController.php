<?php

namespace App\Controllers;

use App\Components\Parser;
use Throwable;

class ApiController extends Controller
{
    protected $data;

    public function run()
    {
        try {
            $this->data = (new Parser())->getDataForTable();
            $this->render('table');
        } catch (Throwable $e) {
            $this->render('error', ['error' => $e->getMessage()]);
        }
    }
}