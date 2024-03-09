<?php

namespace Epush\Queue\App\Service;


use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Queue\App\Contract\QueueDatabaseServiceContract;

class QueueService implements QueueServiceContract
{
    public function __construct(

        private QueueDatabaseServiceContract $queueDatabaseService

    ) {}

    public function checkQueueEnabled(string $queue): bool
    {
        $queueCommand = 'php ' . base_path() . '/artisan queue:work --queue=' . $queue;
        $output = explode("\n", shell_exec('ps aux | grep "' . $queueCommand . '"'));
        $queueProcess = arrayFind($output, fn ($out) => stringContains($out, $queueCommand) && ! stringContains($out, "grep"));

        if (empty($queueProcess)) {
            return false;
        }

        return true;
    }

    public function checkQueuesEnabled(array $queues): array
    {
        $result = [];
        foreach ($queues as $queue) {
            $result[$queue] = $this->checkQueueEnabled($queue);
        }
        return $result;
    }

    public function enableDisableQueue(bool $enabled, string $queue): mixed
    {
        $queueCommand = 'php ' . base_path() . '/artisan queue:work --queue=' . $queue;
        $output = explode("\n", shell_exec('ps aux | grep "' . $queueCommand . '"'));
        $queueProcess = array_filter($output, fn ($out) => stringContains($out, $queueCommand) && ! stringContains($out, "grep"));

        if ($enabled) 
        {
            if (! empty($queueProcess)) {
                return "Queue ". $queue . " is already started";
            }

            if (strtolower($queue) === "database") {
                if (count($queueProcess) < 3) {
                    for ($i=0; $i < (3 - count($queueProcess)); $i++) { 
                        shell_exec("php " . base_path() . "/artisan queue:work --queue=" . $queue . " > /dev/null 2>&1 &disown");
                    }
                }
            } else {
                shell_exec("php " . base_path() . "/artisan queue:work --queue=" . $queue . " > /dev/null 2>&1 &disown");
            }
            return "Queue ". $queue . " started successfully";
        }
        else 
        {
            if (empty($queueProcess)) {
                return "Queue ". $queue . " is already stopped";
            }

            $queueProccessID = "";
            foreach ($queueProcess as $qp) {
                $queueProccessID .= preg_split('/\s+/', $qp)[1]." ";
            }
    
            $output = shell_exec("kill -9 ".$queueProccessID);
    
            if (empty($output)) {
                return "Queue ". $queue . " stopped successfully";
            }
    
            if (stringContains($output, "No such process")) {
                return "Queue ". $queue . " is already stopped";
            }
        }
    }

    public function enableDisableQueues(bool $enabled, array $queues): mixed
    {
        foreach ($queues as $queue) {
            $this->enableDisableQueue($enabled, $queue);
        }

        return "All queues ". ($enabled ? "enabled" : "disabled")." successfully";
    }

    public function getQueueJob(string $jobID): array
    {
        return $this->queueDatabaseService->getQueueJob($jobID);
    }

    public function getQueueFailedJob(string $jobID): array
    {
        return $this->queueDatabaseService->getQueueFailedJob($jobID);
    }

    public function getQueueJobs(string $queue, int $take = 10): array
    {
        return $this->queueDatabaseService->getQueueJobs($queue, $take);
    }

    public function getQueueFailedJobs(string $queue, int $take = 10): array
    {
        return $this->queueDatabaseService->getQueueFailedJobs($queue, $take);
    }

    public function searchQueueJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return $this->queueDatabaseService->searchQueueJobColumn($queue, $column, $value, $take);
    }

    public function searchQueueFailedJobColumn(string $queue, string $column, string $value, int $take = 10): array
    {
        return $this->queueDatabaseService->searchQueueFailedJobColumn($queue, $column, $value, $take);
    }
}