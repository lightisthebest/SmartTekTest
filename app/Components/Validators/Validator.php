<?php

namespace App\Components\Validators;

abstract class Validator implements ValidatorInterface
{
    protected $errors = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}