<?php

namespace Epush\File\Domain\UseCases\Excel;

use Epush\File\Domain\DTOs\DataDto;
use Epush\File\App\Contracts\Excel\ExcelServiceContract;
use Epush\Shared\App\Contracts\ValidationServiceContract;
use Epush\Shared\Present\ResponseContract;

class ExportExcelUseCase
{
    public function __construct(
        public ExcelServiceContract $excelService,
        public ValidationServiceContract $validationService
    ) {}

    public function execute(DataDto $dataDto): ResponseContract
    {
        $this->validationService->validate($dataDto, DataDto::rules());
        return $this->excelService->export($dataDto);
    }
}