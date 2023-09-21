<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\SMS\App\Contract\EpushSMSServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SendSMSMessageMicroprocess implements MicroprocessContract
{
    public function __construct(

        private EpushSMSServiceContract $smsService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$to, $message] = $data;
        return $this->smsService->sendMessage($to, $message);
    }
}