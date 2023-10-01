<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageGroup\Domain\DTO\MessageGroupDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageGroupUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageGroupDto $messageGroupDto): bool
    {
        $this->validationService->validate($messageGroupDto->toArray(), MessageGroupDto::rules());
        return $this->messageGroupService->delete($messageGroupDto->getMessageGroupID());
    }
}