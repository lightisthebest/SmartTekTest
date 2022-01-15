<?php

namespace App\Components;

use App\Components\Validators\FileRowValidator;
use App\Components\Validators\FileValidator;
use Exception;

class Parser
{
    private $file;
    private $data = [];

    /**
     * @throws Exception
     */
    public function getDataForTable(): array
    {
        $this->checkFile();
        $this->convertFileToArray();
        return $this->parseData();
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkFile()
    {
        $file = $_FILES['file'] ?? null;
        $validator = new FileValidator($file);
        if ($validator->validate()) {
            throw new Exception(join('<br>', $validator->getErrors()));
        }
        $this->file = $file;
    }

    /**
     * @throws Exception
     */
    private function convertFileToArray()
    {
        $file = fopen($this->file['tmp_name'], 'r');
        if ($file === false) {
            throw new Exception('Failed to open a file. Please, try again or choose another file');
        }
        $validator = new FileRowValidator();
        while (($data = fgetcsv($file)) !== false) {
            $row = new FileRow($data);
            if ($validator->setRow($row)->validate()) {
                $this->data[] = $row;
            } else {
                Errors::add($validator->getErrors());
            }
        }
        fclose($file);
    }

    /**
     * @return array
     * @throws Exception
     */
    private function parseData(): array
    {
        $result = [];
        $newElement = [
            'continent' => [
                'calls' => 0,
                'duration' => 0
            ],
            'all' => [
                'calls' => 0,
                'duration' => 0
            ]
        ];
        /** @var FileRow $item */
        foreach ($this->data as $item) {
            if (!isset($result[$item->id])) {
                $result[$item->id] = $newElement;
            }
            $result[$item->id]['all']['calls']++;
            $result[$item->id]['all']['duration'] += $item->duration;
            $ipCountry = IPStack::getContinent($item->ip);
            $phoneCountry = Phone::getContinent($item->phone);
            if ($ipCountry === $phoneCountry) {
                $result[$item->id]['continent']['calls']++;
                $result[$item->id]['continent']['duration'] += $item->duration;
            }
        }
        return $result;
    }
}