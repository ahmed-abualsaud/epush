<?php

namespace Epush\Core\MessageFilter\Domain\UseCase;

use Epush\Core\MessageFilter\Domain\DTO\ListMessageFiltersDto;
use Epush\Core\MessageFilter\App\Contract\MessageFilterServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageFiltersUseCase
{
    public function __construct(

        private MessageFilterServiceContract $messageFilterService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageFiltersDto $listMessageFiltersDto): array
    {
        $this->validationService->validate($listMessageFiltersDto->toArray(), ListMessageFiltersDto::rules());
        return $this->messageFilterService->list($listMessageFiltersDto->getPageSize());
    }
}