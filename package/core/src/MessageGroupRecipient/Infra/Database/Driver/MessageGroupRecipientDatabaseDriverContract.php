<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Database\Driver;

use Epush\Core\MessageGroupRecipient\Infra\Database\Repository\Contract\MessageGroupRecipientRepositoryContract;

interface MessageGroupRecipientDatabaseDriverContract
{
    public function messageGroupRecipientRepository(): MessageGroupRecipientRepositoryContract;
}