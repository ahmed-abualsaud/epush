<?php

namespace Epush\Core\MessageRecipient\Infra\Database\Driver;

use Epush\Core\MessageRecipient\Infra\Database\Repository\Contract\MessageRecipientRepositoryContract;

class MessageRecipientDatabaseDriver implements MessageRecipientDatabaseDriverContract
{
    public function __construct(

        private MessageRecipientRepositoryContract $messageRecipientRepository

    ) {}

    public function messageRecipientRepository(): MessageRecipientRepositoryContract
    {
        return $this->messageRecipientRepository;
    }
}