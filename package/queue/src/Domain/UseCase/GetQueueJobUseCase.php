<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\QueueJobDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetQueueJobUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(QueueJobDto $queueJobDto): array
    {
        $this->validationService->validate($queueJobDto->toArray(), QueueJobDto::rules());
        return $this->queueService->getQueueJob($queueJobDto->getQueueID());
    }
}