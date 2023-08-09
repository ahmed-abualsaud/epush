<?php

namespace Epush\Core\BusinessField\Domain\UseCase;

use Epush\Core\BusinessField\Domain\DTO\BusinessFieldDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

class GetBusinessFieldUseCase
{
    public function __construct(

        private BusinessFieldServiceContract $businessFieldService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BusinessFieldDto $businessFieldDto): array
    {
        $this->validationService->validate($businessFieldDto->toArray(), BusinessFieldDto::rules());
        return $this->businessFieldService->get($businessFieldDto->getBusinessFieldID());
    }
}