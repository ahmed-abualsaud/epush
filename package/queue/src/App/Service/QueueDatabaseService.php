<?php

namespace Epush\Queue\App\Service;

use Epush\Queue\App\Contract\QueueDatabaseServiceContract;
use Epush\Queue\Infra\Database\Driver\QueueDatabaseDriverContract;

class QueueDatabaseService implements QueueDatabaseServiceContract
{
    public function __construct(

        private QueueDatabaseDriverContract $queueDatabaseDriver

    ) {}

    public function getQueueJob(string $jobID): array
    {
        return $this->queueDatabaseDriver->queueRepository()->getQueueJob($jobID);
    }

    public function getQueueFailedJob(string $jobID): array
    {
        return $this->queueDatabaseDriver->queueRepository()->getQueueFailedJob($jobID);
    }

    public function getQueueJobs(string $queue, int $take = 10): array
    {
        return $this->queueDatabaseDriver->queueRepository()->getQueueJobs($queue, $take);
    }

    public function getQueueFailedJobs(string $queue, int $take = 10): array
    {
        return $this->queueDatabaseDriver->queueRepository()->getQueueFailedJobs($queue, $take);
    }

    public function searchQueueJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return $this->queueDatabaseDriver->queueRepository()->searchQueueJobColumn($queue, $column, $value, $take);
    }

    public function searchQueueFailedJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return $this->queueDatabaseDriver->queueRepository()->searchQueueFailedJobColumn($queue, $column, $value, $take);
    }
}