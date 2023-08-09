<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\AppServiceDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetAppServiceContextsUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(AppServiceDto $appServiceDto): array
    {
        $this->validationService->validate($appServiceDto->toArray(), AppServiceDto::rules());
        // $this->monitoringService->sync();
        $appServiceContexts = $this->orchiDatabaseService->getAppServiceContexts($appServiceDto->getServiceID());
        return $appServiceContexts;
    }
}