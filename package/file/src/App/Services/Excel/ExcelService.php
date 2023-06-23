<?php


namespace Epush\File\App\Services\Excel;

use Epush\Shared\Present\ResponseContract;
use Epush\File\Domain\DTOs\DataDTO;
use Epush\File\Infra\Excel\ExcelDriverContract;
use Epush\File\App\Contracts\Excel\ExcelServiceContract;

class ExcelService implements ExcelServiceContract
{

    public function __construct(public ExcelDriverContract $excelDriver) {}

    public function export(DataDTO $dataDTO): ResponseContract
    {
        return $this->excelDriver->download($dataDTO, 'export-'.date('Y-m-d_H:i:s').'.xlsx');
    }
}