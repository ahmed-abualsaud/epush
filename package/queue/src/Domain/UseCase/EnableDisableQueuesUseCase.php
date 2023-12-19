<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\EnableDisableQueuesDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class EnableDisableQueuesUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(EnableDisableQueuesDto $enableDisableQueuesDto): mixed
    {
        $this->validationService->validate($enableDisableQueuesDto->toArray(), EnableDisableQueuesDto::rules());
        return $this->queueService->enableDisableQueues(
            $enableDisableQueuesDto->enabled(),
            $enableDisableQueuesDto->getQueuesName()
        );
    }
}