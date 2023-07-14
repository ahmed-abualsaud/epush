<?php

namespace Epush\Orchi\Domain\UseCase;

use Epush\Orchi\Domain\DTO\HandlerDto;
use Epush\Orchi\Domain\DTO\UpdateHandlerDto;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateHandlerUseCase
{
    public function __construct(

        private ValidationServiceContract $validationService,
        private MonitoringServiceContract $monitoringService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function execute(HandlerDto $handlerDto, UpdateHandlerDto $updateHandlerDto): array
    {
        $this->validationService->validate($handlerDto->toArray(), HandlerDto::rules());
        $this->validationService->validate($updateHandlerDto->toArray(), UpdateHandlerDto::rules());
        $this->monitoringService->sync();
        $handler = $this->orchiDatabaseService->updateHandler($handlerDto->getHandlerID(), $updateHandlerDto->toArray());
        return $handler;
    }
}