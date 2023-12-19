<?php

namespace Epush\SMS\Infra\Driver;

use Epush\SMS\Infra\Job\SendSMSJob;

class SMSDriver implements SMSDriverContract
{
    public function __construct(

        private string $server = '',
        private string $username = '',
        private string $password = '',
        private string $charset = '',
        private string $encoding = '',
        private string $dlrMask = '',
        private string $senderName = '',
        private string $smsc = ''

    ) {

        $this->server = config('sms.kannel_server_url');
        $this->username = config('sms.kannel_username');
        $this->password = config('sms.kannel_password');
        $this->charset = config('sms.kannel_sms_charset');
        $this->encoding = config('sms.kannel_sms_encoding');
        $this->dlrMask = config('sms.kannel_dlr_mask');
        $this->smsc = config('sms.kannel_default_smsc');
        $this->senderName = config('sms.kannel_default_sender_name');
    }




    public function sendSMS(string $message, array $numbers): void
    {            
        if (! empty($numbers)) {

            $chunkedNumbers = array_chunk($numbers, 10);

            foreach ($chunkedNumbers as $chunk)
            {
                dispatch(new SendSMSJob(
                    $this->server,
                    $this->username,
                    $this->password,
                    $this->dlrMask,
                    $this->senderName,
                    $this->smsc,
                    $message,
                    implode(" ", $chunk)
                ));
            }
        }
    }
}