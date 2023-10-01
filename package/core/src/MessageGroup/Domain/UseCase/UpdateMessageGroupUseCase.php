<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\Domain\DTO\MessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\UpdateMessageGroupDto;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageGroupUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageGroupDto $messageGroupDto, UpdateMessageGroupDto $updateMessageGroupDto): array
    {
        $this->validationService->validate($messageGroupDto->toArray(), MessageGroupDto::rules());
        $this->validationService->validate($updateMessageGroupDto->toArray(), UpdateMessageGroupDto::rules());
        return $this->messageGroupService->update($messageGroupDto->getMessageGroupID(), $updateMessageGroupDto->toArray());
    }
}