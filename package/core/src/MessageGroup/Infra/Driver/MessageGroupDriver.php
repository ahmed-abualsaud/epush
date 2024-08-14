<?php

namespace Epush\Core\MessageGroup\Infra\Driver;

use Epush\Core\MessageGroup\Infra\Job\InsertMessageGroupJob;

class MessageGroupDriver implements MessageGroupDriverContract
{
    public function insertRecipients(string $groupID, array $recipients): void
    {
        dispatch( new InsertMessageGroupJob($groupID, $recipients));
    }
    
}