<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SendToMailMicroprocess implements MicroprocessContract
{
    public function __construct(

        private MailServiceContract $mailService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$mail, $subject, $content] = $data;
        return $this->mailService->sendMail($mail, $subject, $content);
    }
}