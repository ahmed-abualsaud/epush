<?php

namespace Epush\File\Domain\UseCase\PDF;

use Epush\File\Domain\DTO\DataDto;
use Epush\File\App\Contract\PDF\PDFServiceContract;

use Epush\Shared\Domain\Entity\FileDownload;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ExportPDFUseCase
{
    public function __construct(
        private PDFServiceContract $PDFService,
        private ValidationServiceContract $validationService
    ) {}

    public function execute(DataDto $dataDto): FileDownload
    {
        $this->validationService->validate($dataDto->toArray(), DataDto::rules());
        return $this->PDFService->export($dataDto->toArray());
    }
}