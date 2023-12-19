<?php

namespace Epush\Core\Message\Infra\Driver;

use Epush\Core\Message\Infra\Job\SendMessageJob;

class MessageDriver implements MessageDriverContract
{
    public function __construct(

        private string $server = '',
        private string $username = '',
        private string $password = '',
        private string $charset = '',
        private string $encoding = '',
        private string $dlrMask = ''

    ) {

        $this->server = config('kannel.kannel_server_url');
        $this->username = config('kannel.kannel_username');
        $this->password = config('kannel.kannel_password');
        $this->charset = config('kannel.kannel_sms_charset');
        $this->encoding = config('kannel.kannel_sms_encoding');
        $this->dlrMask = config('kannel.kannel_dlr_mask');

    }




    public function sendMessage(string $senderName, string $smsc, string $message, array $numbers, string $language = "english"): void
    {            
        if (! empty($numbers)) {

            $chunkedNumbers = array_chunk($numbers, 10);

            foreach ($chunkedNumbers as $chunk)
            {
                strtolower($language) === "arabic" ?

                dispatch(new SendMessageJob(
                    $this->server,
                    $this->username,
                    $this->password,
                    $this->dlrMask,
                    $senderName,
                    $smsc,
                    $message,
                    implode(" ", $chunk),
                    $this->charset,
                    $this->encoding
                )) :

                dispatch(new SendMessageJob(
                    $this->server,
                    $this->username,
                    $this->password,
                    $this->dlrMask,
                    $senderName,
                    $smsc,
                    $message,
                    implode(" ", $chunk)
                ));
            }
        }
    }
}