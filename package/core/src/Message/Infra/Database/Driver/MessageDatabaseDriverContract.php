<?php

namespace Epush\Core\Message\Infra\Database\Driver;

use Epush\Core\Message\Infra\Database\Repository\Contract\MessageRepositoryContract;

interface MessageDatabaseDriverContract
{
    public function messageRepository(): MessageRepositoryContract;
}