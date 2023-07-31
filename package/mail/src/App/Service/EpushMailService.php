<?php

namespace Epush\Mail\App\Service;

use Epush\Mail\App\Contract\EpushMailServiceContract;
use Epush\Mail\Infra\EpushMail\EpushMailDriverContract;

class EpushMailService implements EpushMailServiceContract
{
    public function __construct(

        private EpushMailDriverContract $epushMailDriver

    ) {}

    public function sendClientAddedMail(string $to, array $data): void
    {
        $this->epushMailDriver->sendMail($to, 'client-added', $data);
    }
} 