<?php

namespace Epush\Queue\Infra\Database\Driver;

use Epush\Queue\Infra\Database\Repository\Contract\QueueRepositoryContract;

class QueueDatabaseDriver implements QueueDatabaseDriverContract
{
    public function __construct(

        private QueueRepositoryContract $queueRepository

    ) {}

    public function queueRepository(): QueueRepositoryContract
    {
        return $this->queueRepository;
    }
}