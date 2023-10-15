<?php

namespace Epush\Notification\Infra\Job;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\BroadcastMessage;



class SendNotificationJob extends Notification implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
     
    /**
     * Create a new job instance.
     */
    public function __construct(

        private string $content,
        private string $subject,

    ) {

        $this->onQueue('notification');
        $this->onConnection('database');
        $this->afterCommit();

    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return (new BroadcastMessage([
            'subject' => $this->subject,
            'content' => $this->content
        ]))
        ->onQueue('notification')
        ->onConnection('database')
        ->afterCommit();

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
    }
}