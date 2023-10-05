<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\Domain\DTO\AddMessageFilterDto;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddMessageFilterUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMessageFilterDto $addMessageFilterDto): array
    {
        $this->validationService->validate($addMessageFilterDto->toArray(), AddMessageFilterDto::rules());
        return $this->messageFilterService->add($addMessageFilterDto->toArray());
    }
}