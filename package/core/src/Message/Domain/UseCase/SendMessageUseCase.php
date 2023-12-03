<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\SendMessageDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;

class SendMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SendMessageDto $sendMessageDto): mixed
    {
        $this->validationService->validate($sendMessageDto->toArray(), $sendMessageDto::rules());
        return $this->messageService->sendMessage($sendMessageDto->toArray());
    }
}