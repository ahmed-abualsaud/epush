<?php

namespace Epush\Shared\App\Contract;

interface MailServiceContract
{
    public function sendClientAddedMail(string $to, array $data): void;
}