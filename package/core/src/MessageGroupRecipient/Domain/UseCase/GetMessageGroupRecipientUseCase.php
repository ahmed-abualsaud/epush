<?php

namespace Epush\Core\MessageGroupRecipient\Domain\UseCase;

use Epush\Core\MessageGroupRecipient\Domain\DTO\MessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageGroupRecipientUseCase
{
    public function __construct(

        private MessageGroupRecipientServiceContract $messageGroupRecipientService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageGroupRecipientDto $messageGroupRecipientDto): array
    {
        $this->validationService->validate($messageGroupRecipientDto->toArray(), MessageGroupRecipientDto::rules());
        return $this->messageGroupRecipientService->get($messageGroupRecipientDto->getMessageGroupRecipientID());
    }
}