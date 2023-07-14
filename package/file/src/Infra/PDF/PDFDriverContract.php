<?php

namespace Epush\File\Infra\PDF;

use Epush\Shared\Domain\Entity\FileDownload;

interface PDFDriverContract
{
    public function download(array $data, string $fileName): FileDownload;
}