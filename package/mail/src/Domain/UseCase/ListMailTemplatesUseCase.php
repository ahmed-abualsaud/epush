<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\App\Contract\MailServiceContract;

class ListMailTemplatesUseCase
{
    public function __construct(

        private MailServiceContract $MailService

    ) {}

    public function execute(): array
    {
        return $this->MailService->listMailTemplates();
    }
}