<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\Domain\DTO\AddMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageGroupRecipientUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageGroupRecipientDto $addMessageGroupRecipientDto): int
    {
        $this->validationService->validate($addMessageGroupRecipientDto->toArray(), AddMessageGroupRecipientDto::rules());
        return $this->messageGroupRecipientService->add($addMessageGroupRecipientDto->getGroupID(), $addMessageGroupRecipientDto->getGroupRecipients());
    }
}