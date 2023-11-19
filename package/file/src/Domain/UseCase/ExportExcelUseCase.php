<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\ExportDto;
use Epush\Shared\Domain\Entity\FileDownload;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ExportExcelUseCase
{
    public function __construct(
        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService
    ) {}

    public function execute(ExportDto $exportDto): FileDownload
    {
        $this->validationService->validate($exportDto->toArray(), ExportDto::rules());
        return $this->fileService->exportExcel($exportDto->toArray());
    }
}