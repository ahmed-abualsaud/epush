<?php

namespace Epush\Core\MessageGroup\Infra\Database\Driver;

use Epush\Core\MessageGroup\Infra\Database\Repository\Contract\MessageGroupRepositoryContract;

class MessageGroupDatabaseDriver implements MessageGroupDatabaseDriverContract
{
    public function __construct(

        private MessageGroupRepositoryContract $messageGroupRepository

    ) {}

    public function messageGroupRepository(): MessageGroupRepositoryContract
    {
        return $this->messageGroupRepository;
    }
}