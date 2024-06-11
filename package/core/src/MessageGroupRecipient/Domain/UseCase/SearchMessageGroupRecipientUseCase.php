<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\Domain\DTO\SearchMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageGroupRecipientUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageGroupRecipientDto $searchMessageGroupRecipientDto): array
    {
        $this->validationService->validate($searchMessageGroupRecipientDto->toArray(), SearchMessageGroupRecipientDto::rules());
        return $this->messageGroupRecipientService->searchColumn(
            $searchMessageGroupRecipientDto->getSearchColumn(),
            $searchMessageGroupRecipientDto->getSearchValue(),
            $searchMessageGroupRecipientDto->getPageSize(),
            $searchMessageGroupRecipientDto->getPartnerID()
        );
    }
}