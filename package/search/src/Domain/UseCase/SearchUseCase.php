<?php

namespace Epush\Search\Domain\UseCase;

use Epush\Search\Domain\DTO\SearchDto;
use Epush\Search\App\Contract\SearchServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchUseCase
{
    public function __construct(

        private SearchServiceContract $searchService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchDto $searchDto): array
    {
        $this->validationService->validate($searchDto->toArray(), SearchDto::rules());
        return $this->searchService->search(
            $searchDto->getEntity(),
            $searchDto->getCriteria(),
            $searchDto->getPageSize(),
            $searchDto->getPageNumber()
        );
    }
}