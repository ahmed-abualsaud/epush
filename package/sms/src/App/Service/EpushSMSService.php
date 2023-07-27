<?php

namespace Epush\SMS\App\Service;

use Epush\SMS\App\Contract\EpushSMSServiceContract;
use Epush\SMS\Infra\EpushSMS\EpushSMSDriverContract;

class EpushSMSService implements EpushSMSServiceContract
{
    public function __construct(

        private EpushSMSDriverContract $epushSMSDriver

    ) {}


    public function sendMessage($to, $message): array
    {
        return $this->epushSMSDriver->sendMessage($to, $message);
    }
}