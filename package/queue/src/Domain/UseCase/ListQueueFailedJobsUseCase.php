<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\ListQueueFailedJobsDto;

use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListQueueFailedJobsUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListQueueFailedJobsDto $listQueueFailedJobsDto): array
    {
        $this->validationService->validate($listQueueFailedJobsDto->toArray(), ListQueueFailedJobsDto::rules());
        return $this->queueService->getQueueFailedJobs(
            $listQueueFailedJobsDto->getQueueName(), 
            $listQueueFailedJobsDto->getPageSize()
        );
    }
}