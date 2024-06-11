<?php

namespace Epush\Core\MessageRecipient\Domain\UseCase;

use Epush\Core\MessageRecipient\Domain\DTO\SearchMessageRecipientDto;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageRecipientUseCase
{
    public function __construct(

        private MessageRecipientServiceContract $messageRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageRecipientDto $searchMessageRecipientDto): array
    {
        $this->validationService->validate($searchMessageRecipientDto->toArray(), SearchMessageRecipientDto::rules());
        return $this->messageRecipientService->searchColumn(
            $searchMessageRecipientDto->getSearchColumn(),
            $searchMessageRecipientDto->getSearchValue(),
            $searchMessageRecipientDto->getPageSize(),
            $searchMessageRecipientDto->getPartnerID()
        );
    }
}