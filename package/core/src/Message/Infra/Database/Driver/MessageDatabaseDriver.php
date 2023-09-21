<?php

namespace Epush\Core\Message\Infra\Database\Driver;

use Epush\Core\Message\Infra\Database\Repository\Contract\MessageRepositoryContract;

class MessageDatabaseDriver implements MessageDatabaseDriverContract
{
    public function __construct(

        private MessageRepositoryContract $messageRepository

    ) {}

    public function MessageRepository(): MessageRepositoryContract
    {
        return $this->messageRepository;
    }
}