<?php

namespace Epush\File\Infra\Excel;

use Epush\Shared\Domain\Entity\FileDownload;

interface ExcelDriverContract
{
    public function download(array $data, string $fileName): FileDownload;
}