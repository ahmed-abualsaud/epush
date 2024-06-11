<?php

namespace Epush\Core\Client\Domain\UseCase;

use Epush\Core\Client\Domain\DTO\SearchClientDto;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchClientUseCase
{
    public function __construct(

        private ClientServiceContract $clientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchClientDto $searchClientDto): array
    {
        $this->validationService->validate($searchClientDto->toArray(), SearchClientDto::rules());
        return $this->clientService->searchColumn(
            $searchClientDto->getSearchColumn(),
            $searchClientDto->getSearchValue(),
            $searchClientDto->searchClient(),
            $searchClientDto->getPageSize(),
            $searchClientDto->getPartnerID()
        );
    }
}