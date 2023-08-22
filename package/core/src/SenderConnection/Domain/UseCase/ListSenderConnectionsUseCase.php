<?php

namespace Epush\Core\SenderConnection\Domain\UseCase;

use Epush\Core\SenderConnection\Domain\DTO\ListSenderConnectionsDto;
use Epush\Core\SenderConnection\App\Contract\SenderConnectionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListSenderConnectionsUseCase
{
    public function __construct(

        private SenderConnectionServiceContract $senderConnectionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListSenderConnectionsDto $listSenderConnectionsDto): array
    {
        $this->validationService->validate($listSenderConnectionsDto->toArray(), ListSenderConnectionsDto::rules());
        return $this->senderConnectionService->list($listSenderConnectionsDto->getPageSize());
    }
}