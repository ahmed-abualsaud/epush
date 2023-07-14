<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\AppServiceDto;
use Epush\Orchi\Domain\DTO\UpdateAppServiceDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateAppServiceUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(AppServiceDto $appServiceDto, UpdateAppServiceDto $updateAppServiceDto): array
    {
        $this->validationService->validate($appServiceDto->toArray(), AppServiceDto::rules());
        $this->validationService->validate($updateAppServiceDto->toArray(), UpdateAppServiceDto::rules());
        $this->monitoringService->sync();
        $appService = $this->orchiDatabaseService->updateAppService($appServiceDto->getServiceID(), $updateAppServiceDto->toArray());
        return $appService;
    }
}