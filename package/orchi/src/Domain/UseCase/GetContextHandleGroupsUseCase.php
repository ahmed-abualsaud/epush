<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\ContextDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetContextHandleGroupsUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(ContextDto $contextDto): array
    {
        $this->validationService->validate($contextDto->toArray(), ContextDto::rules());
        $this->monitoringService->sync();
        $contextHandleGroups = $this->orchiDatabaseService->getContextHandleGroups($contextDto->getContextID());
        return $contextHandleGroups;
    }
}