<?php

namespace Epush\Queue\App\Contract;

interface QueueServiceContract
{
    public function checkQueueEnabled(string $queue): bool;

    public function checkQueuesEnabled(array $queues): array;

    public function enableDisableQueue(bool $enabled, string $queue): mixed;

    public function enableDisableQueues(bool $enabled, array $queues): mixed;

    public function getQueueJob(string $jobID): array;

    public function getQueueFailedJob(string $jobID): array;

    public function getQueueJobs(string $queue, int $take = 10): array;

    public function getQueueFailedJobs(string $queue, int $take = 10): array;

    public function searchQueueJobColumn(string $queue, string $column, string $value, int $take = 10): array;

    public function searchQueueFailedJobColumn(string $queue, string $column, string $value, int $take = 10): array;
}