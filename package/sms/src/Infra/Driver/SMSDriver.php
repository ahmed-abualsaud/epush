<?php

namespace Epush\SMS\Infra\Driver;

use Epush\SMS\Infra\Job\SendSMSJob;

class SMSDriver implements SMSDriverContract
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




    public function sendSMS(string $to, string $message): array
    {
        dispatch(new SendSMSJob(
            $this->server,
            $this->username,
            $this->password,
            $this->apiKey,
            $this->from,
            $message,
            $to
        ));

        return [];
    }
}