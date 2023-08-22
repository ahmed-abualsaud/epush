<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\SearchSenderDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchSenderUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchSenderDto $searchSenderDto): array
    {
        $this->validationService->validate($searchSenderDto->toArray(), SearchSenderDto::rules());
        return $this->senderService->searchColumn(
            $searchSenderDto->getSearchColumn(),
            $searchSenderDto->getSearchValue(),
            $searchSenderDto->getPageSize()
        );
    }
}