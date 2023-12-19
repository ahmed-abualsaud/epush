<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\CheckQueueEnabledDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class CheckQueueEnabledUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(CheckQueueEnabledDto $checkQueueEnabledDto): mixed
    {
        $this->validationService->validate($checkQueueEnabledDto->toArray(), CheckQueueEnabledDto::rules());
        return $this->queueService->checkQueueEnabled(
            $checkQueueEnabledDto->getQueueName()
        );
    }
}