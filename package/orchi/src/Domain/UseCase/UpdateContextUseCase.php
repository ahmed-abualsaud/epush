<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\ContextDto;
use Epush\Orchi\Domain\DTO\UpdateContextDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateContextUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(ContextDto $contextDto, UpdateContextDto $updateContextDto): array
    {
        $this->validationService->validate($contextDto->toArray(), ContextDto::rules());
        $this->validationService->validate($updateContextDto->toArray(), UpdateContextDto::rules());
        // $this->monitoringService->sync();
        $context = $this->orchiDatabaseService->updateContext($contextDto->getContextID(), $updateContextDto->toArray());
        return $context;
    }
}