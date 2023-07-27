<?php


namespace Epush\File\App\Service\Excel;


use Epush\File\Infra\Excel\ExcelDriverContract;
use Epush\File\App\Contract\Excel\ExcelServiceContract;

use Epush\Shared\Domain\Entity\FileDownload;

class ExcelService implements ExcelServiceContract
{

    public function __construct(

        private ExcelDriverContract $excelDriver

    ) {}


    public function export(array $data): FileDownload
    {
        return $this->excelDriver->download($data, 'export-'.date('Y-m-d_H:i:s').'.xlsx');
    }
}