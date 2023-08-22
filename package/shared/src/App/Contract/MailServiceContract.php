<?php

namespace Epush\Shared\App\Contract;

interface MailServiceContract
{
    public function sendClientAddedMail(string $to, array $data): void;

    public function sendOrderAddedMail(string $to, array $data): void;
}