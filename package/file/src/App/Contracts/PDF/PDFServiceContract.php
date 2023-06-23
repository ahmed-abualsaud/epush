<?php

namespace Epush\File\App\Contracts\PDF;

use Epush\Shared\Present\ResponseContract;
use Epush\File\Domain\DTOs\DataDTO;

interface PDFServiceContract
{
    public function export(DataDTO $dataDTO): ResponseContract;
}