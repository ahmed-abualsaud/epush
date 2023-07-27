<?php

namespace Epush\Shared\App\Contract;

interface SMSServiceContract
{
    public function sendMessage($to, $message): array;
}