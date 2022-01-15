<?php

namespace App\Components\Validators;

class FileValidator extends Validator
{
    const ALLOWED_FILES = [
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    ];

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!$this->file || !empty($this->file['error'])) {
            $this->errors[] = 'File is not loaded correctly. Please, try again';
            return false;
        }
        if (!isset($file['tmp_name'])) {
            $this->errors[] = 'Can\'t check file\'s mime type';
            return false;
        }
        $info = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($info, $file['tmp_name']);
        finfo_close($info);
        if (!in_array($mime, self::ALLOWED_FILES)) {
            $this->errors[] = 'File is not a csv file. Please, try again or choose another file';
            return false;
        }
        return true;
    }
}