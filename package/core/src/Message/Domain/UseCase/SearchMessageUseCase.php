<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\SearchMessageDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageDto $searchMessageDto): array
    {
        $this->validationService->validate($searchMessageDto->toArray(), SearchMessageDto::rules());
        return $this->messageService->searchColumn(
            $searchMessageDto->getSearchColumn(),
            $searchMessageDto->getSearchValue(),
            $searchMessageDto->getPageSize()
        );
    }
}