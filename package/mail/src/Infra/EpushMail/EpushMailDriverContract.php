<?php

namespace Epush\Mail\Infra\EpushMail;

interface EpushMailDriverContract
{
    public function sendMail(string $to, string $template, array $data): void;
}