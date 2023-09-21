<?php

namespace Epush\Mail\Infra\Database\Driver;

use Epush\Mail\Infra\Database\Repository\Contract\MailTemplateRepositoryContract;
use Epush\Mail\Infra\Database\Repository\Contract\MailSendingHandlerRepositoryContract;

interface MailDatabaseDriverContract
{
    public function mailTemplateRepository(): MailTemplateRepositoryContract;

    public function mailSendingHandlerRepository(): MailSendingHandlerRepositoryContract;
}