<?php

namespace Epush\Core\MessageGroup\Domain\UseCase;

use Epush\Core\MessageGroup\Domain\DTO\ListMessageGroupsDto;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageGroupsUseCase
{
    public function __construct(

        private MessageGroupServiceContract $messageGroupService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageGroupsDto $listMessageGroupsDto): array
    {
        $this->validationService->validate($listMessageGroupsDto->toArray(), ListMessageGroupsDto::rules());
        return $this->messageGroupService->list($listMessageGroupsDto->getPageSize());
    }
}