<?php

namespace Epush\Core\Message\Infra\Driver;

interface MessageDriverContract
{
    public function sendMessage(array $numbers, string $message): void;
}