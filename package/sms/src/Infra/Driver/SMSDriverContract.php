<?php

namespace Epush\SMS\Infra\Driver;

interface SMSDriverContract
{
    public function sendSMS(string $message, array $numbers): void;
}