<?php

namespace Epush\File\Infra\PDF;

use Epush\File\Domain\DTOs\DataDTO;
use Epush\Shared\Present\ResponseContract;

interface PDFDriverContract
{
    public function download(DataDTO $dataDto, string $fileName): ResponseContract;
}