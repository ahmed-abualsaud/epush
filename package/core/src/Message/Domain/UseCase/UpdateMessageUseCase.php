<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\MessageDto;
use Epush\Core\Message\Domain\DTO\UpdateMessageDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageDto $messageDto, UpdateMessageDto $updateMessageDto): array
    {
        $this->validationService->validate($messageDto->toArray(), MessageDto::rules());
        $this->validationService->validate($updateMessageDto->toArray(), UpdateMessageDto::rules());
        return $this->messageService->update($messageDto->getMessageID(), $updateMessageDto->toArray());
    }
}