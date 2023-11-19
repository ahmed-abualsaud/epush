<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Sender\App\Contract\SenderDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientSendersMicroprocess implements MicroprocessContract
{
    public function __construct(

        private SenderDatabaseServiceContract $senderService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        return $this->senderService->getClientSenders($userID);
    }
}