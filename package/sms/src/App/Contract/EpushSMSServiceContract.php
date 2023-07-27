<?php

namespace Epush\SMS\App\Contract;

interface EpushSMSServiceContract
{
    public function sendMessage($to, $message): array;
}