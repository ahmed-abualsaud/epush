<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\SearchHandlerDto;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchHandlerUseCase
{
    public function __construct(

        private OrchiDatabaseServiceContract $handlerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchHandlerDto $searchHandlerDto): array
    {
        $this->validationService->validate($searchHandlerDto->toArray(), SearchHandlerDto::rules());
        return $this->handlerService->searchHandlerColumn(
            $searchHandlerDto->getSearchColumn(),
            $searchHandlerDto->getSearchValue(),
            $searchHandlerDto->getPageSize()
        );
    }
}