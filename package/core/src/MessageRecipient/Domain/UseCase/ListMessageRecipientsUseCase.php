<?php

namespace Epush\Core\MessageRecipient\Domain\UseCase;

use Epush\Core\MessageRecipient\Domain\DTO\ListMessageRecipientsDto;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageRecipientsUseCase
{
    public function __construct(

        private MessageRecipientServiceContract $messageRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageRecipientsDto $listMessageRecipientsDto): array
    {
        $this->validationService->validate($listMessageRecipientsDto->toArray(), ListMessageRecipientsDto::rules());
        return $this->messageRecipientService->list($listMessageRecipientsDto->getPageSize(), $listMessageRecipientsDto->getPartnerID());
    }
}