<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\MessageDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageDto $messageDto): bool
    {
        $this->validationService->validate($messageDto->toArray(), MessageDto::rules());
        return $this->messageService->delete($messageDto->getMessageID());
    }
}