<?php

namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\SMS\App\Contract\EpushSMSServiceContract;

class SMSService implements SMSServiceContract
{
    public function __construct(

        private EpushSMSServiceContract $epushSMSService

    ) {}

    public function sendMessage($to, $message): array
    {
        return $this->epushSMSService->sendMessage($to, $message);
    }
}