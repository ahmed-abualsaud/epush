<?php

namespace Epush\Queue\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Queue\Infra\Database\Model\Job;
use Epush\Queue\Infra\Database\Model\FailedJob;
use Epush\Queue\Infra\Database\Repository\Contract\QueueRepositoryContract;


class QueueRepository implements QueueRepositoryContract
{
    public function __construct(

        private Job $job,

        private FailedJob $failedJob
        
    ) {}

    public function getQueueJob(string $jobID): array
    {
        return DB::transaction(function () use ($jobID) {

            return $this->job->find($jobID)->toArray();

        });
    }

    public function getQueueFailedJob(string $jobID): array
    {
        return DB::transaction(function () use ($jobID) {

            return $this->failedJob->find($jobID)->toArray();

        });
    }

    public function getQueueJobs(string $queue, int $take = 10): array
    {
        return DB::transaction(function () use ($queue, $take) {

            return $this->job->where('queue', $queue)->paginate($take)->toArray();

        });
    }

    public function getQueueFailedJobs(string $queue, int $take = 10): array
    {
        return DB::transaction(function () use ($queue, $take) {

            return $this->failedJob->where('queue', $queue)->paginate($take)->toArray();

        });
    }

    public function searchQueueJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($queue, $column, $value, $take) {

            return $this->job
                ->where('queue', $queue)
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)
                ->toArray();
        });
    }

    public function searchQueueFailedJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($queue, $column, $value, $take) {

            return $this->failedJob
                ->where('queue', $queue)
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)
                ->toArray();
        });
    }
}