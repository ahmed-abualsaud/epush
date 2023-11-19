<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\FolderDto;
use Epush\File\Domain\DTO\UpdateFolderDto;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateFolderUseCase
{
    public function __construct(

        private FolderServiceContract $folderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(FolderDto $folderDto, UpdateFolderDto $updateFolderDto): array
    {
        $this->validationService->validate($folderDto->toArray(), FolderDto::rules());
        $this->validationService->validate($updateFolderDto->toArray(), UpdateFolderDto::rules());
        return $this->folderService->update($folderDto->getFolderID(), $updateFolderDto->toArray());
    }
}