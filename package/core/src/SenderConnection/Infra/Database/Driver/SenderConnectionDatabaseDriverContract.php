<?php

namespace Epush\Core\SenderConnection\Infra\Database\Driver;

use Epush\Core\SenderConnection\Infra\Database\Repository\Contract\SenderConnectionRepositoryContract;

interface SenderConnectionDatabaseDriverContract
{
    public function senderConnectionRepository(): SenderConnectionRepositoryContract;
}