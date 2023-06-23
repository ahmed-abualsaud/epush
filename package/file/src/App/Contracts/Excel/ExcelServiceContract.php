<?php

namespace Epush\File\App\Contracts\Excel;

use Epush\Shared\Present\ResponseContract;
use Epush\File\Domain\DTOs\DataDTO;

interface ExcelServiceContract
{
    public function export(DataDTO $dataDTO): ResponseContract;
}