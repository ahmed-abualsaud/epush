<?php

namespace Epush\Core\Message\Infra\Driver;

interface MessageDriverContract
{
    public function sendMessage(string $senderName, string $smsc, string $message, array $numbers, string $language = "english"): void;

    public function insertMessage(array $message, array $messageGroupRecipients, string $status = 'Sent'): void;
}