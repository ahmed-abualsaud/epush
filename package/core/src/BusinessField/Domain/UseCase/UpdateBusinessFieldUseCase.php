<?php

namespace Epush\Core\BusinessField\Domain\UseCase;

use Epush\Core\BusinessField\Domain\DTO\BusinessFieldDto;
use Epush\Core\BusinessField\Domain\DTO\UpdateBusinessFieldDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

class UpdateBusinessFieldUseCase
{
    public function __construct(

        private BusinessFieldServiceContract $businessFieldService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BusinessFieldDto $businessFieldDto, UpdateBusinessFieldDto $updateBusinessFieldDto): array
    {
        $this->validationService->validate($businessFieldDto->toArray(), BusinessFieldDto::rules());
        $this->validationService->validate($updateBusinessFieldDto->toArray(), UpdateBusinessFieldDto::rules());
        return $this->businessFieldService->update($businessFieldDto->getBusinessFieldID(), $updateBusinessFieldDto->toArray());
    }
}