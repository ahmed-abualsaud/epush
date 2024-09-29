<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Core\Message\App\Contract\MessageDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;


class GetClientMessagesMicroprocess implements MicroprocessContract
{
    public function __construct(

        private MessageDatabaseServiceContract $messageService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$userID] = $data;
        $take = count($data) >= 2 ? $data[1] : null;
        return $this->messageService->getClientMessages($userID, $take);
    }
}