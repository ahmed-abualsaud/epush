<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\AddMessageDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageDto $addMessageDto): array
    {
        $this->validationService->validate($addMessageDto->toArray(), AddMessageDto::rules());
        return $this->messageService->add(
            $addMessageDto->getUserID(), 
            $addMessageDto->getMessage(), 
            $addMessageDto->getRecipients(), 
            $addMessageDto->getSegments()
        );
    }
}