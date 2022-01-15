<?php

namespace App\Components\Validators;

use App\Components\FileRow;

class FileRowValidator extends Validator
{
    /** @var FileRow */
    private $row;
    private static $counter = 1;

    /**
     * @param FileRow $row
     * @return $this
     */
    public function setRow(FileRow $row): FileRowValidator
    {
        $this->errors = [];
        $this->row = $row;
        return $this;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (strtotime($this->row->time) === false) {
            $this->addError('wrong call date');
        }

        if (!ctype_digit($this->row->duration)) {
            $this->addError('duration is not a number');
        }

        if (!filter_var($this->row->ip, FILTER_VALIDATE_IP)) {
            $this->addError("not valid IP address");
        }
        self::$counter++;
        return empty($this->errors);
    }

    /**
     * @param string $error
     * @return void
     */
    private function addError(string $error)
    {
        $this->errors[] = 'Error in row ' . self::$counter . ': ' . $error;
    }
}