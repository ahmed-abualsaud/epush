<?php

namespace Epush\Mail\Infra\Database\Driver;

use Epush\Mail\Infra\Database\Repository\Contract\MailTemplateRepositoryContract;
use Epush\Mail\Infra\Database\Repository\Contract\MailSendingHandlerRepositoryContract;

class MailDatabaseDriver implements MailDatabaseDriverContract
{
    public function __construct(

        private MailTemplateRepositoryContract $mailTemplateRepository,
        private MailSendingHandlerRepositoryContract $mailSendingHandlerRepository

    ) {}

    public function mailTemplateRepository(): MailTemplateRepositoryContract
    {
        return $this->mailTemplateRepository;
    }

    public function MailSendingHandlerRepository(): MailSendingHandlerRepositoryContract
    {
        return $this->mailSendingHandlerRepository;
    }
}