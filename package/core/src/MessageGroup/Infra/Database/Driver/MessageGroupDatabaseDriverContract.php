<?php

namespace Epush\Core\MessageGroup\Infra\Database\Driver;

use Epush\Core\MessageGroup\Infra\Database\Repository\Contract\MessageGroupRepositoryContract;

interface MessageGroupDatabaseDriverContract
{
    public function messageGroupRepository(): MessageGroupRepositoryContract;
}