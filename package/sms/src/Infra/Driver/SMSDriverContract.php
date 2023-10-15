<?php

namespace Epush\SMS\Infra\Driver;

interface SMSDriverContract
{
    public function sendSMS(string $to, string $message): array;
}