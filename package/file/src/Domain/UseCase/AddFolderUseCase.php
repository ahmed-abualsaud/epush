<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\AddFolderDto;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddFolderUseCase
{
    public function __construct(

        private FolderServiceContract $folderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddFolderDto $addFolderDto): array
    {
        $this->validationService->validate($addFolderDto->toArray(), AddFolderDto::rules());
        return $this->folderService->add($addFolderDto->toArray());
    }
}