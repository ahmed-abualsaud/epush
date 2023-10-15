<?php

namespace Epush\Mail\Infra\Driver;

use Illuminate\Support\Facades\Mail;
use Epush\Mail\Infra\Job\SendMailJob;


class MailDriver implements MailDriverContract
{
    public function sendMail(string $to, string $subject, string $content): void
    {
        Mail::to($to)->send(new SendMailJob($subject, $content));
    }
}