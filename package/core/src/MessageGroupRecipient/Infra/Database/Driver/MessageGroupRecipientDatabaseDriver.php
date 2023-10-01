<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Database\Driver;

use Epush\Core\MessageGroupRecipient\Infra\Database\Repository\Contract\MessageGroupRecipientRepositoryContract;

class MessageGroupRecipientDatabaseDriver implements MessageGroupRecipientDatabaseDriverContract
{
    public function __construct(

        private MessageGroupRecipientRepositoryContract $messageGroupRecipientRepository

    ) {}

    public function messageGroupRecipientRepository(): MessageGroupRecipientRepositoryContract
    {
        return $this->messageGroupRecipientRepository;
    }
}