<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\GetMessageRecipientsDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageRecipientsUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(GetMessageRecipientsDto $getMessageRecipientsDto): array
    {
        $this->validationService->validate($getMessageRecipientsDto->toArray(), GetMessageRecipientsDto::rules());
        return $this->messageService->getMessageRecipients(
            $getMessageRecipientsDto->getMessageID(), 
            $getMessageRecipientsDto->getPageSize(), 
        );
    }
}