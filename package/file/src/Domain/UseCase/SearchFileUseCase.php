<?php

namespace Epush\File\Domain\UseCase;

use Epush\File\Domain\DTO\SearchFileDto;
use Epush\File\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchFileUseCase
{
    public function __construct(

        private FileServiceContract $fileService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchFileDto $searchFileDto): array
    {
        $this->validationService->validate($searchFileDto->toArray(), SearchFileDto::rules());
        return $this->fileService->searchColumn(
            $searchFileDto->getSearchColumn(),
            $searchFileDto->getSearchValue(),
            $searchFileDto->getPageSize()
        );
    }
}