<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\FileDto;
use Epush\File\Domain\DTO\UpdateFileDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateFileUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(FileDto $fileDto, UpdateFileDto $updateFileDto): array
    {
        $this->validationService->validate($fileDto->toArray(), FileDto::rules());
        $this->validationService->validate($updateFileDto->toArray(), UpdateFileDto::rules());
        return $this->fileService->update($fileDto->getFileID(), $updateFileDto->toArray());
    }
}