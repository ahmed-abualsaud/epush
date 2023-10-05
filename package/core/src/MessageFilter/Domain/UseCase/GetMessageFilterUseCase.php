<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\Domain\DTO\MessageFilterDto;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMessageFilterUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MessageFilterDto $messageFilterDto): array
    {
        $this->validationService->validate($messageFilterDto->toArray(), MessageFilterDto::rules());
        return $this->messageFilterService->get($messageFilterDto->getMessageFilterID());
    }
}