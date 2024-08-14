<?php

namespace Epush\Core\MessageGroup\Infra\Driver;

interface MessageGroupDriverContract
{
    public function insertRecipients(string $groupID, array $recipients): void;
}