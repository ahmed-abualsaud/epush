<?php

namespace Epush\Core\Sender\Domain\UseCase;

use Epush\Core\Sender\Domain\DTO\ListSendersDto;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSendersUseCase
{
    public function __construct(

        private SenderServiceContract $senderService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSendersDto $listSendersDto): array
    {
        $this->validationService->validate($listSendersDto->toArray(), ListSendersDto::rules());
        return $this->senderService->list($listSendersDto->getPageSize());
    }
}