<?php

namespace Epush\Core\Message\Domain\UseCase;

use Epush\Core\Message\Domain\DTO\OldApiCheckBalanceDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;

class OldApiCheckBalanceUseCase
{
    public function __construct(

        private MessageServiceContract $messageService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OldApiCheckBalanceDto $oldApiCheckBalanceDto): mixed
    {
        // $this->validationService->validate($oldApiCheckBalanceDto->toArray(), OldApiCheckBalanceDto::rules());
        return $this->messageService->oldApiCheckBalance($oldApiCheckBalanceDto->toArray());
    }
}