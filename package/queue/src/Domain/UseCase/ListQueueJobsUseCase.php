<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\ListQueueJobsDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListQueueJobsUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListQueueJobsDto $listQueueJobsDto): array
    {
        $this->validationService->validate($listQueueJobsDto->toArray(), ListQueueJobsDto::rules());
        return $this->queueService->getQueueJobs(
            $listQueueJobsDto->getQueueName(),
            $listQueueJobsDto->getPageSize()
        );
    }
}