<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait SpreadsheetTrait
{

    protected $spreadsheet;
    protected $spreadsheet_file;
    protected $sheet_index;

    public function newSpreadsheet($file = 'spreadsheet', $sheet = 'Sheet1', $headers = [])
    {
        $this->spreadsheet_file = $file;
        $this->sheet_index = 0;
        $this->spreadsheet = new Spreadsheet;
        $this->spreadsheet->getActiveSheet()->setTitle($sheet);
        if ($headers) {
            $this->setRows($headers, 1);
        }

    }

    public function newSheet($sheet_name, $headers = [])
    {

        $this->sheet_index++;
        $this->spreadsheet->createSheet($this->sheet_index);
        $this->spreadsheet->setActiveSheetIndex($this->sheet_index);
        $this->spreadsheet->getActiveSheet()->setTitle(substr($sheet_name, 0, 30));
        if ($headers) {
            $this->setRows($headers, 1);
        }
    }

    public function setRows($values, $y)
    {

        foreach ($values as $key => $value) {
            $this->spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key + 1, $y, $value);
        }
    }

    public function setCols($values, $x)
    {

        foreach ($values as $key => $value) {
            $this->spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($x, $key + 1, $value);
        }
    }

    public function saveSpreadsheet($path = "")
    {

        $writer = new Xlsx($this->spreadsheet);
        $file = storage_path(str_replace("//", "/", $path . "/") . "{$this->spreadsheet_file}.xlsx");
        $writer->save($file);
        $this->spreadsheet->disconnectWorksheets();
        unset($this->spreadsheet);

        return $file;
    }

}
