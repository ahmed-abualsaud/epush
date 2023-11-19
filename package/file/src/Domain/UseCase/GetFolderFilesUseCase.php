<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\FolderDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetFolderFilesUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(FolderDto $folderDto): array
    {
        $this->validationService->validate($folderDto->toArray(), FolderDto::rules());
        return $this->fileService->getFolderFiles($folderDto->getFolderID());
    }
}