<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\ListFoldersDto;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListFoldersUseCase
{
    public function __construct(

        private FolderServiceContract $folderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListFoldersDto $listFoldersDto): array
    {
        $this->validationService->validate($listFoldersDto->toArray(), ListFoldersDto::rules());
        return $this->folderService->list($listFoldersDto->getPageSize());
    }
}