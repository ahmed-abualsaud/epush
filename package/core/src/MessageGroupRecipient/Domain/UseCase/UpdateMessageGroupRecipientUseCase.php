<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\Domain\DTO\MessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\UpdateMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageGroupRecipientUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageGroupRecipientDto $messageGroupRecipientDto, UpdateMessageGroupRecipientDto $updateMessageGroupRecipientDto): array
    {
        $this->validationService->validate($messageGroupRecipientDto->toArray(), MessageGroupRecipientDto::rules());
        $this->validationService->validate($updateMessageGroupRecipientDto->toArray(), UpdateMessageGroupRecipientDto::rules());
        return $this->messageGroupRecipientService->update($messageGroupRecipientDto->getMessageGroupRecipientID(), $updateMessageGroupRecipientDto->toArray());
    }
}