<?php

namespace Epush\SMS\Infra\EpushSMS;

use Epush\SMS\Infra\Job\SendSMSJob;

class EpushSMSDriver implements EpushSMSDriverContract
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




    public function sendMessage($to, $message): array
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