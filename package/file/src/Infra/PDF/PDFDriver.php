<?php

namespace Epush\File\Infra\PDF;

use PDF;

use Epush\File\Domain\DTOs\DataDto;
use Epush\Shared\Present\Response;
use Epush\Shared\Present\ResponseContract;

class PDFDriver implements PDFDriverContract
{
    public function download(DataDto $data, string $fileName): ResponseContract
    {
        return new Response(PDF::loadView('file::data', $data->toArray())->download($fileName));
    }
}