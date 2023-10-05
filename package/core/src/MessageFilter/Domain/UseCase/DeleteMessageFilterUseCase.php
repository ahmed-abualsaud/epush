<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Core\MessageFilter\Domain\DTO\MessageFilterDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMessageFilterUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageFilterDto $messageFilterDto): bool
    {
        $this->validationService->validate($messageFilterDto->toArray(), MessageFilterDto::rules());
        return $this->messageFilterService->delete($messageFilterDto->getMessageFilterID());
    }
}