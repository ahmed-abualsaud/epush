<?php

namespace Epush\Core\Message\Infra\Driver;

use Epush\Core\Message\Infra\Job\SendMessageJob;

class MessageDriver implements MessageDriverContract
{
    public function __construct(

        private string $server = '',
        private string $username = '',
        private string $password = '',
        private string $apiKey = '',
        private string $from = ''

    ) {

        $this->server = config('sms.sms_server_url');
        $this->username = config('sms.sms_username');
        $this->password = config('sms.sms_password');
        $this->apiKey = config('sms.sms_api_key');
        $this->from = config('sms.sms_from');

    }




    public function sendMessage(array $numbers, string $message): void
    {            
        if (! empty($numbers)) {
            foreach ($numbers as $number) {
                dispatch(new SendMessageJob(
                    $this->server,
                    $this->username,
                    $this->password,
                    $this->apiKey,
                    $this->from,
                    $message,
                    $number
                ));
            }
        }
    }
}