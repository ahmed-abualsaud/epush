<?php

namespace Epush\File\Infra\Excel;

use Epush\File\Domain\DTOs\DataDto;
use Epush\Shared\Present\Response;
use Epush\Shared\Present\ResponseContract;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelDriver implements ExcelDriverContract
{

    public function download(DataDto $data, string $fileName): ResponseContract
    {
        return new Response(Excel::download(new DataExport($data), $fileName));
    }
}

class DataExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(DataDto $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data->getRows();
    }

    public function headings(): array
    {
        return $this->data->getColumns();
    }
}