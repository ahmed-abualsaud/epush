<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\Domain\DTO\SearchMessageFilterDto;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageFilterUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageFilterDto $searchMessageFilterDto): array
    {
        $this->validationService->validate($searchMessageFilterDto->toArray(), SearchMessageFilterDto::rules());
        return $this->messageFilterService->searchColumn(
            $searchMessageFilterDto->getSearchColumn(),
            $searchMessageFilterDto->getSearchValue(),
            $searchMessageFilterDto->getPageSize()
        );
    }
}