<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;

class ListAppServicesUseCase
{
    public function __construct(

        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(): array
    {
        $this->monitoringService->sync();
        $appServices = $this->orchiDatabaseService->getAllAppServices();
        return $appServices;
    }
}