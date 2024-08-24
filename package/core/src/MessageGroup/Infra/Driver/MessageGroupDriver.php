<?php

namespace Epush\Core\MessageGroup\Infra\Driver;

use Epush\Core\MessageGroup\Infra\Job\InsertMessageGroupJob;
use Epush\Core\MessageGroup\Infra\Job\InsertMessageRecipientsJob;

class MessageGroupDriver implements MessageGroupDriverContract
{
    public function insertRecipients(string $groupID, array $recipients, string $messageID = null, string $status = null): void
    {
        if (empty($messageID) || empty($status)) {
            dispatch( new InsertMessageGroupJob($groupID, $recipients));
        } else {
            InsertMessageGroupJob::withChain([
                new InsertMessageRecipientsJob($groupID, $messageID, $status)
            ])->dispatch($groupID, $recipients);
        }
    }
    
}