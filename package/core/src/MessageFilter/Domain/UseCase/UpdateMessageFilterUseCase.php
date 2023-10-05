<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\Domain\DTO\MessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\UpdateMessageFilterDto;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMessageFilterUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageFilterDto $messageFilterDto, UpdateMessageFilterDto $updateMessageFilterDto): array
    {
        $this->validationService->validate($messageFilterDto->toArray(), MessageFilterDto::rules());
        $this->validationService->validate($updateMessageFilterDto->toArray(), UpdateMessageFilterDto::rules());
        return $this->messageFilterService->update($messageFilterDto->getMessageFilterID(), $updateMessageFilterDto->toArray());
    }
}