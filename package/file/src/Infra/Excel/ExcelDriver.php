<?php

namespace Epush\File\Infra\Excel;

use Epush\Shared\Domain\Entity\FileDownload;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelDriver implements ExcelDriverContract
{

    public function download(array $data, string $fileName): FileDownload
    {
        return new FileDownload($fileName, Excel::raw(new DataExport($data), 'Xlsx'));
    }
}

class DataExport implements FromArray, WithHeadings
{

    public function __construct(private array $data) {}

    public function array(): array
    {
        return $this->data['rows']?? [];
    }

    public function headings(): array
    {
        return $this->data['columns']?? [];
    }
}