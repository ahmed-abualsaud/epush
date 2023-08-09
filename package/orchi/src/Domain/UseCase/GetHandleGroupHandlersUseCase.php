<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\HandleGroupDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetHandleGroupHandlersUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(HandleGroupDto $handleGroupDto): array
    {
        $this->validationService->validate($handleGroupDto->toArray(), HandleGroupDto::rules());
        // $this->monitoringService->sync();
        $handleGroupHandlers = $this->orchiDatabaseService->getHandleGroupHandlers($handleGroupDto->getHandleGroupID());
        return $handleGroupHandlers;
    }
}