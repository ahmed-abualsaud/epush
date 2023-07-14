<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\HandleGroupDto;
use Epush\Orchi\Domain\DTO\UpdateHandleGroupDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateHandleGroupUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(HandleGroupDto $handlegroupDto, UpdateHandleGroupDto $updateHandleGroupDto): array
    {
        $this->validationService->validate($handlegroupDto->toArray(), HandleGroupDto::rules());
        $this->validationService->validate($updateHandleGroupDto->toArray(), UpdateHandleGroupDto::rules());
        $this->monitoringService->sync();
        $handleGroup = $this->orchiDatabaseService->updateHandleGroup($handlegroupDto->getHandleGroupID(), $updateHandleGroupDto->toArray());
        return $handleGroup;
    }
}