<?php

namespace Epush\Core\BusinessField\Domain\UseCase;

use Epush\Core\BusinessField\Domain\DTO\BusinessFieldDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

class DeleteBusinessFieldUseCase
{
    public function __construct(

        private BusinessFieldServiceContract $businessFieldService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BusinessFieldDto $businessFieldDto): bool
    {
        $this->validationService->validate($businessFieldDto->toArray(), BusinessFieldDto::rules());
        return $this->businessFieldService->delete($businessFieldDto->getBusinessFieldID());
    }
}