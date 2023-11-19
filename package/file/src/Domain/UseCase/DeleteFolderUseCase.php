<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\FolderDto;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteFolderUseCase
{
    public function __construct(

        private FolderServiceContract $folderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(FolderDto $folderDto): bool
    {
        $this->validationService->validate($folderDto->toArray(), FolderDto::rules());
        return $this->folderService->delete($folderDto->getFolderID());
    }
}