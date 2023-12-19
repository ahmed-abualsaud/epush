<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\SearchQueueJobDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchQueueJobUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchQueueJobDto $searchQueueJobDto): array
    {
        $this->validationService->validate($searchQueueJobDto->toArray(), SearchQueueJobDto::rules());
        return $this->queueService->searchQueueJobColumn(
            $searchQueueJobDto->getQueueName(),
            $searchQueueJobDto->getSearchColumn(),
            $searchQueueJobDto->getSearchValue(),
            $searchQueueJobDto->getPageSize()
        );
    }
}