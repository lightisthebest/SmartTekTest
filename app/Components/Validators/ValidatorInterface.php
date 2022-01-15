<?php

namespace App\Components\Validators;

interface ValidatorInterface
{
    public function validate(): bool;
    public function getErrors(): array;
}