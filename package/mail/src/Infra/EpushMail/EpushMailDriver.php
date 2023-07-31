<?php

namespace Epush\Mail\Infra\EpushMail;

use Epush\Mail\Infra\Mail\ClientAdded;
use Illuminate\Support\Facades\Mail;


class EpushMailDriver implements EpushMailDriverContract
{
    public function sendMail(string $to, string $template, array $data): void
    {
        switch ($template) {
            case 'client-added':
                Mail::to($to)->send(new ClientAdded($data));
                break;
            
            default:
                # code...
                break;
        }
    }
}