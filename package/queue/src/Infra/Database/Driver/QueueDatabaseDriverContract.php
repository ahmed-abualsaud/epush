<?php

namespace Epush\Queue\Infra\Database\Driver;

use Epush\Queue\Infra\Database\Repository\Contract\QueueRepositoryContract;

interface QueueDatabaseDriverContract
{
    public function queueRepository(): QueueRepositoryContract;
}