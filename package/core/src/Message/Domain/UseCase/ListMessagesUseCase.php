<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\ListMessagesDto;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessagesUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessagesDto $listMessagesDto): array
    {
        $this->validationService->validate($listMessagesDto->toArray(), ListMessagesDto::rules());
        return $this->messageService->list($listMessagesDto->getPageSize());
    }
}