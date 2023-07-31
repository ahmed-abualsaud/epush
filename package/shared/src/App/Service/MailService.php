<?php

namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\MailServiceContract;
use Epush\Mail\App\Contract\EpushMailServiceContract;

class MailService implements MailServiceContract
{
    public function __construct(

        private EpushMailServiceContract $epushMailService

    ) {}

    public function sendClientAddedMail(string $to, array $data): void
    {
        $this->epushMailService->sendClientAddedMail($to, $data);
    }
}