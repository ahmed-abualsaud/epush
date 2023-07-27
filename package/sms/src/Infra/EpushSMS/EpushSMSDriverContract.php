<?php

namespace Epush\SMS\Infra\EpushSMS;

interface EpushSMSDriverContract
{
    public function sendMessage($to, $message): array;
}