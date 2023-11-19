<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\SearchFolderDto;
use Epush\File\App\Contract\FolderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchFolderUseCase
{
    public function __construct(

        private FolderServiceContract $folderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchFolderDto $searchFolderDto): array
    {
        $this->validationService->validate($searchFolderDto->toArray(), SearchFolderDto::rules());
        return $this->folderService->searchColumn(
            $searchFolderDto->getSearchColumn(),
            $searchFolderDto->getSearchValue(),
            $searchFolderDto->getPageSize()
        );
    }
}