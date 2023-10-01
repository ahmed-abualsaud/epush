<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Core\MessageGroupRecipient\Domain\DTO\MessageGroupRecipientDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageGroupRecipientUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageGroupRecipientDto $messageGroupRecipientDto): bool
    {
        $this->validationService->validate($messageGroupRecipientDto->toArray(), MessageGroupRecipientDto::rules());
        return $this->messageGroupRecipientService->delete($messageGroupRecipientDto->getMessageGroupRecipientID());
    }
}