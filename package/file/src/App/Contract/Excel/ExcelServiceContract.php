<?php

namespace Epush\File\App\Contract\Excel;

use Epush\Shared\Domain\Entity\FileDownload;

interface ExcelServiceContract
{
    public function export(array $data): FileDownload;
}