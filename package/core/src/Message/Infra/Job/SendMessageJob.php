<?php

namespace Epush\Core\Message\Infra\Job;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class SendMessageJob implements ShouldQueue
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

        private string $server,
        private string $username,
        private string $password,
        private string $dlrMask,
        private string $senderName,
        private string $smsc,
        private string $message,
        private string $to,
        private string $charset = "",
        private string $encoding = "",

    ) {

        $this->onQueue(str_replace(" ", "_", $senderName));
        $this->onConnection('database');
        $this->afterCommit();

    }
    
    public function handle(): void
    {
        try {
            $attributes = [

                'username' => $this->username,
                'password' => $this->password,
                'dlr-mask' => $this->dlrMask,
                'from' => $this->senderName,
                'text' => $this->message,
                'smsc' => $this->smsc,
                'to' => $this->to
    
            ];
    
            if (! empty($this->charset)) {
                $attributes['charset'] = $this->charset;
            }
    
            if (! empty($this->encoding)) {
                $attributes['encoding'] = $this->encoding;
            }
    
            $response = Http::withOptions(['verify' => false])->get($this->server, $attributes);
            
            if ($response->ok()) {
    
                Log::info(json_encode($response->json()));
    
            } else {
    
                $errorMessage = $response->body();
                Log::error('Send Message Failed: ' . $response->status() . ' - ' . $errorMessage);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->release();
        }
    }

    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
        $this->release();
    }
}