<?php

namespace Epush\File\Domain\UseCases\PDF;

use Epush\File\Domain\DTOs\DataDto;
use Epush\File\App\Contracts\PDF\PDFServiceContract;
use Epush\Shared\App\Contracts\ValidationServiceContract;
use Epush\Shared\Present\ResponseContract;

class ExportPDFUseCase
{
    public function __construct(
        public PDFServiceContract $PDFService,
        public ValidationServiceContract $validationService
    ) {}

    public function execute(DataDto $dataDto): ResponseContract
    {
        $this->validationService->validate($dataDto, DataDto::rules());
        return $this->PDFService->export($dataDto);
    }
}