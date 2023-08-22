<?php

namespace Epush\Mail\App\Contract;

interface EpushMailServiceContract
{
    public function sendClientAddedMail(string $to, array $data): void;

    public function sendOrderAddedMail(string $to, array $data): void;
} 