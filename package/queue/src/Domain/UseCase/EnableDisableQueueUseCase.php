<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\EnableDisableQueueDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class EnableDisableQueueUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(EnableDisableQueueDto $enableDisableQueueDto): mixed
    {
        $this->validationService->validate($enableDisableQueueDto->toArray(), EnableDisableQueueDto::rules());
        return $this->queueService->enableDisableQueue(
            $enableDisableQueueDto->enabled(),
            $enableDisableQueueDto->getQueueName()
        );
    }
}