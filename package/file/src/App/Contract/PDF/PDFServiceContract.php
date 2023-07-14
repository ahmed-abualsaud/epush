<?php

namespace Epush\File\App\Contract\PDF;

use Epush\Shared\Domain\Entity\FileDownload;

interface PDFServiceContract
{
    public function export(array $data): FileDownload;
}