<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\Domain\DTO\ListMessageGroupRecipientsDto;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageGroupRecipientsUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageGroupRecipientsDto $listMessageGroupRecipientsDto): array
    {
        $this->validationService->validate($listMessageGroupRecipientsDto->toArray(), ListMessageGroupRecipientsDto::rules());
        return $this->messageGroupRecipientService->list($listMessageGroupRecipientsDto->getPageSize());
    }
}