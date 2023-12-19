<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\SearchQueueFailedJobDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchQueueFailedJobUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchQueueFailedJobDto $searchQueueFailedJobDto): array
    {
        $this->validationService->validate($searchQueueFailedJobDto->toArray(), SearchQueueFailedJobDto::rules());
        return $this->queueService->searchQueueFailedJobColumn(
            $searchQueueFailedJobDto->getQueueName(),
            $searchQueueFailedJobDto->getSearchColumn(),
            $searchQueueFailedJobDto->getSearchValue(),
            $searchQueueFailedJobDto->getPageSize()
        );
    }
}