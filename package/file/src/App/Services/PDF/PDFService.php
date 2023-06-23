<?php


namespace Epush\File\App\Services\PDF;

use Epush\Shared\Present\ResponseContract;
use Epush\File\Domain\DTOs\DataDTO;
use Epush\File\Infra\PDF\PDFDriverContract;
use Epush\File\App\Contracts\PDF\PDFServiceContract;

class PDFService implements PDFServiceContract
{

    public function __construct(public PDFDriverContract $PDFDriver) {}

    public function export(DataDTO $dataDTO): ResponseContract
    {
        return $this->PDFDriver->download($dataDTO, 'export-'.date('Y-m-d_H:i:s').'.pdf');
    }
}