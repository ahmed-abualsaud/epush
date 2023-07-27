<?php

namespace Epush\SMS\Infra\Job;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSMSJob implements ShouldQueue
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
        private string $apiKey,
        private string $from,
        private string $message,
        private string $to,

    ) {

        $this->onQueue('sms');
        $this->onConnection('database');

    }
    
    public function handle(): void
    {
        $response = Http::withOptions(['verify' => false])->get($this->server, [

            'username' => $this->username,
            'password' => $this->password,
            'message' => $this->message,
            'api_key' => $this->apiKey,
            'from' => $this->from,
            'to' => $this->to

        ]);
        
        if ($response->ok()) {

            Log::info(json_encode($response->json()));

        } else {

            $errorMessage = $response->body();
            throw new Exception('Send SMS Failed: ' . $response->status() . ' - ' . $errorMessage);
        }
    }

    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
    }
}