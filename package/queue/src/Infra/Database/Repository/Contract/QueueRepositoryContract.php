<?php

namespace Epush\Queue\Infra\Database\Repository\Contract;

interface QueueRepositoryContract
{
    public function getQueueJob(string $jobID): array;

    public function getQueueFailedJob(string $jobID): array;

    public function getQueueJobs(string $queue, int $take = 10): array;

    public function getQueueFailedJobs(string $queue, int $take = 10): array;

    public function searchQueueJobColumn(string $queue, string $column, string $value, int $take = 10): array;

    public function searchQueueFailedJobColumn(string $queue, string $column, string $value, int $take = 10): array;
}