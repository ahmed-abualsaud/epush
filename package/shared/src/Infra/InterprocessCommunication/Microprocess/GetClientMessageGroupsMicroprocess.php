<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\MessageGroup\App\Contract\MessageGroupDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientMessageGroupsMicroprocess implements MicroprocessContract
{
    public function __construct(

        private MessageGroupDatabaseServiceContract $messageGroupService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        return $this->messageGroupService->getClientMessageGroups($userID);
    }
}