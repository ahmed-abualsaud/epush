<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SendSMSMicroprocess implements MicroprocessContract
{
    public function __construct(

        private SMSServiceContract $smsService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$handler, $request, $response] = $data;
        return $this->smsService->checkAndSendSMS($handler, $request, $response);
    }
}