<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\OldApiSendBulkDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;

class OldApiSendBulkUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OldApiSendBulkDto $oldApiSendBulkDto): mixed
    {
        // $this->validationService->validate($oldApiSendBulkDto->toArray(), OldApiSendBulkDto::rules());
        return $this->messageService->oldApiSendBulk($oldApiSendBulkDto->toArray());
    }
}