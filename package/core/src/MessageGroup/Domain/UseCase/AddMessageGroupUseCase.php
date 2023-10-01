<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\Domain\DTO\AddMessageGroupDto;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageGroupUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageGroupDto $addMessageGroupDto): array
    {
        $this->validationService->validate($addMessageGroupDto->toArray(), AddMessageGroupDto::rules());
        return $this->messageGroupService->add($addMessageGroupDto->getMessageGroup(), $addMessageGroupDto->getMessageGroupRecipients());
    }
}