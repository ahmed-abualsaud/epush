<?php

namespace Epush\File\Domain\UseCase\Excel;

use Epush\File\Domain\DTO\DataDto;
use Epush\File\App\Contract\Excel\ExcelServiceContract;

use Epush\Shared\Domain\Entity\FileDownload;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ExportExcelUseCase
{
    public function __construct(
        private ExcelServiceContract $excelService,
        private ValidationServiceContract $validationService
    ) {}

    public function execute(DataDto $dataDto): FileDownload
    {
        $this->validationService->validate($dataDto->toArray(), DataDto::rules());
        return $this->excelService->export($dataDto->toArray());
    }
}