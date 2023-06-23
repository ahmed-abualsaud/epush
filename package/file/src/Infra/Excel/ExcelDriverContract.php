<?php

namespace Epush\File\Infra\Excel;

use Epush\File\Domain\DTOs\DataDTO;
use Epush\Shared\Present\ResponseContract;

interface ExcelDriverContract
{
    public function download(DataDTO $dataDto, string $fileName): ResponseContract;
}