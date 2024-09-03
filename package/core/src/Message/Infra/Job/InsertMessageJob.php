<?php

namespace Epush\Core\Message\Infra\Job;

use Epush\Queue\App\Contract\QueueServiceContract;

use Epush\Core\Message\App\Contract\MessageServiceContract;
use Epush\Core\MessageGroup\App\Contract\MessageGroupServiceContract;
use Epush\Core\MessageRecipient\App\Contract\MessageRecipientServiceContract;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InsertMessageJob implements ShouldQueue
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
        private array $message,
        private array $messageGroupRecipients,
    ) {
        $this->onQueue("database");
        $this->onConnection('database');
        $this->afterCommit();
    }
    
    public function handle() : void
    {
        $status = array_key_exists('scheduled_at', $this->message) && Carbon::parse($this->message['scheduled_at'])->gte(Carbon::now()) ? 'Scheduled' : (array_key_exists('approved', $this->message) ? 'Sent' : 'Pending');

        foreach ($this->messageGroupRecipients as $messageGroupRecipient) {
            $msgrcp = app(MessageGroupServiceContract::class)->addAndGetRecipients([
                'name' => $messageGroupRecipient['name'],
                'user_id' => $messageGroupRecipient['user_id']
            ], $messageGroupRecipient['recipients']);
            app(MessageRecipientServiceContract::class)->add($this->message['id'], array_column($msgrcp, 'id'), $status);
        }

        app(MessageServiceContract::class)->update($this->message['id'], ['sent' => true]);
        app(QueueServiceContract::class)->enableDisableQueue(true, "database");
    }

    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
        $this->release();
    }
}