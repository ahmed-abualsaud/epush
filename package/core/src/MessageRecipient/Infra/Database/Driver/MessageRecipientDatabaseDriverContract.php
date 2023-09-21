<?php

namespace Epush\Core\MessageRecipient\Infra\Database\Driver;

use Epush\Core\MessageRecipient\Infra\Database\Repository\Contract\MessageRecipientRepositoryContract;

interface MessageRecipientDatabaseDriverContract
{
    public function messageRecipientRepository(): MessageRecipientRepositoryContract;
}