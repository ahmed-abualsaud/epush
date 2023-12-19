<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\QueueFailedJobDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetQueueFailedJobUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(QueueFailedJobDto $queueFailedJobDto): array
    {
        $this->validationService->validate($queueFailedJobDto->toArray(), QueueFailedJobDto::rules());
        return $this->queueService->getQueueFailedJob($queueFailedJobDto->getQueueID());
    }
}