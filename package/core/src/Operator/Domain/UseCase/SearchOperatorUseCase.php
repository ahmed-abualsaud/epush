<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\Domain\DTO\SearchOperatorDto;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchOperatorUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchOperatorDto $searchOperatorDto): array
    {
        $this->validationService->validate($searchOperatorDto->toArray(), SearchOperatorDto::rules());
        return $this->operatorService->searchColumn(
            $searchOperatorDto->getSearchColumn(),
            $searchOperatorDto->getSearchValue(),
            $searchOperatorDto->getPageSize()
        );
    }
}