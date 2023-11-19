<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\ListFilesDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListFilesUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListFilesDto $listFilesDto): array
    {
        $this->validationService->validate($listFilesDto->toArray(), ListFilesDto::rules());
        return $this->fileService->list($listFilesDto->getPageSize());
    }
}