<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\FileDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteFileUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(FileDto $fileDto): bool
    {
        $this->validationService->validate($fileDto->toArray(), FileDto::rules());
        return $this->fileService->delete($fileDto->getFileID());
    }
}