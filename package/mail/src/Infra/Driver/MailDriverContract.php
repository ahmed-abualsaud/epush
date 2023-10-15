<?php

namespace Epush\Mail\Infra\Driver;

interface MailDriverContract
{
    public function sendMail(string $to, string $subject, string $content): void;
}