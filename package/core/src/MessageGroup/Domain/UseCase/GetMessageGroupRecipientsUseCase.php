<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\Domain\DTO\GetMessageGroupRecipientsDto;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageGroupRecipientsUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(GetMessageGroupRecipientsDto $getMessageGroupRecipientsDto): array
    {
        $this->validationService->validate($getMessageGroupRecipientsDto->toArray(), GetMessageGroupRecipientsDto::rules());
        return $this->messageGroupService->getMessageGroupRecipients(
            $getMessageGroupRecipientsDto->getMessageGroupID(),
            $getMessageGroupRecipientsDto->getPageSize()
        );
    }
}