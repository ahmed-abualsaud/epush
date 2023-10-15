<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\ListHandlersDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;

class ListHandlersUseCase
{
    public function __construct(

        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService,
        private ValidationServiceContract $validationService


    ) {}

    public function execute(ListHandlersDto $listHandlersDto): array
    {
        $this->validationService->validate($listHandlersDto->toArray(), ListHandlersDto::rules());
        // $this->monitoringService->sync();
        return $this->orchiDatabaseService->getAllHandlers($listHandlersDto->getPageSize());
    }
}