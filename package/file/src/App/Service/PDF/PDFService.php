<?php


namespace Epush\File\App\Service\PDF;

use Epush\File\Infra\PDF\PDFDriverContract;

use Epush\Shared\Domain\Entity\FileDownload;
use Epush\File\App\Contract\PDF\PDFServiceContract;

class PDFService implements PDFServiceContract
{

    public function __construct(

        private PDFDriverContract $PDFDriver

    ) {}


    public function export(array $data): FileDownload
    {
        return $this->PDFDriver->download($data, 'export-'.date('Y-m-d_H:i:s').'.pdf');
    }
}