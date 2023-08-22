<?php

namespace Epush\Core\Sender\Infra\Database\Driver;

use Epush\Core\Sender\Infra\Database\Repository\Contract\SenderRepositoryContract;

interface SenderDatabaseDriverContract
{
    public function senderRepository(): SenderRepositoryContract;
}