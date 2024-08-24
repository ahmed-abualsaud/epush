<?php

namespace Epush\Core\MessageGroup\Infra\Driver;

interface MessageGroupDriverContract
{
    public function insertRecipients(string $groupID, array $recipients, string $messageID = null, string $status = null): void;
}