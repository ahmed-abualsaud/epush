<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientMessagesStatsMicroprocess implements MicroprocessContract
{
    public function __construct(

        private MessageDatabaseServiceContract $messageService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        return $this->messageService->getClientMessagesStats($userID);
    }
}