<?php

namespace Epush\Mail\Infra\EpushMail;

use Illuminate\Support\Facades\Mail;

use Epush\Mail\Infra\Mail\OrderAdded;
use Epush\Mail\Infra\Mail\ClientAdded;


class EpushMailDriver implements EpushMailDriverContract
{
    public function sendMail(string $to, string $template, array $data): void
    {
        switch ($template) {
            case 'client-added':
                Mail::to($to)->send(new ClientAdded($data));
                break;
            
            case 'order-added':
                Mail::to($to)->send(new OrderAdded($data));
                break;
            
            default:
                # code...
                break;
        }
    }
}