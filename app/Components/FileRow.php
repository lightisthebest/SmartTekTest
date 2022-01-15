<?php

namespace App\Components;

class FileRow
{
    public $id;
    public $time;
    public $duration;
    public $phone;
    public $ip;

    public function __construct(array $attributes)
    {
        $this->id = array_shift($attributes);
        $this->time = array_shift($attributes);
        $this->duration = array_shift($attributes);
        $this->phone = preg_replace('/[^0-9]/', '', array_shift($attributes));
        $this->ip = array_shift($attributes);
    }
}