<?php

namespace Epush\Queue\Domain\UseCase;

use Epush\Queue\Domain\DTO\CheckQueuesEnabledDto;
use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class CheckQueuesEnabledUseCase
{
    public function __construct(

        private QueueServiceContract $queueService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(CheckQueuesEnabledDto $checkQueuesEnabledDto): mixed
    {
        $this->validationService->validate($checkQueuesEnabledDto->toArray(), CheckQueuesEnabledDto::rules());
        return $this->queueService->checkQueuesEnabled(
            $checkQueuesEnabledDto->getQueuesName()
        );
    }
}