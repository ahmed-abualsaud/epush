<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\SearchSenderConnectionDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSenderConnectionUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSenderConnectionDto $searchSenderConnectionDto): array
    {
        $this->validationService->validate($searchSenderConnectionDto->toArray(), SearchSenderConnectionDto::rules());
        return $this->senderConnectionService->searchColumn(
            $searchSenderConnectionDto->getSearchColumn(),
            $searchSenderConnectionDto->getSearchValue(),
            $searchSenderConnectionDto->getPageSize()
        );
    }
}