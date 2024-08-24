<?php

namespace Epush\Core\MessageGroup\Infra\Job;

use Epush\Queue\App\Contract\QueueServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageGroupRecipient\App\Contract\MessageGroupRecipientServiceContract;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InsertMessageGroupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    public $timeout = 3600; // Set timeout to 1 hour

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $groupID,
        private array $recipients,

    ) {
        $this->onQueue("database");
        $this->onConnection('database');
        $this->afterCommit();
    }
    
    public function handle() : void
    {
        $count = app(MessageGroupRecipientServiceContract::class)->add($this->groupID, $this->recipients);
        app(MessageGroupServiceContract::class)->update($this->groupID, ['number_of_recipients' => $count]);
        app(QueueServiceContract::class)->enableDisableQueue(true, "database");
    }

    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
        $this->release();
    }
}