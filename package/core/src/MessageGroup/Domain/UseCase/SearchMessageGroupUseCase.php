<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\Domain\DTO\SearchMessageGroupDto;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageGroupUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageGroupDto $searchMessageGroupDto): array
    {
        $this->validationService->validate($searchMessageGroupDto->toArray(), SearchMessageGroupDto::rules());
        return $this->messageGroupService->searchColumn(
            $searchMessageGroupDto->getSearchColumn(),
            $searchMessageGroupDto->getSearchValue(),
            $searchMessageGroupDto->getPageSize(),
            $searchMessageGroupDto->getPartnerID()
        );
    }
}