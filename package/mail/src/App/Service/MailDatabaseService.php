<?php

namespace Epush\Mail\App\Service;

use Epush\Mail\App\Contract\MailDatabaseServiceContract;
use Epush\Mail\Infra\Database\Driver\MailDatabaseDriverContract;

class MailDatabaseService implements MailDatabaseServiceContract
{
    public function __construct(

        private MailDatabaseDriverContract $mailDatabaseDriver

    ) {}

    public function listMailTemplates(): array
    {
        return $this->mailDatabaseDriver->mailTemplateRepository()->all();
    }

    public function getMailTemplate(string $templateID): array
    {
        return $this->mailDatabaseDriver->mailTemplateRepository()->get($templateID);
    }

    public function addMailTemplate(array $template): array
    {
        return $this->mailDatabaseDriver->mailTemplateRepository()->create($template);
    }

    public function updateMailTemplate(string $templateID, array $template): array
    {
        return $this->mailDatabaseDriver->mailTemplateRepository()->update($templateID, $template);
    }
    
    public function deleteMailTemplate(string $templateID): bool
    {
        return $this->mailDatabaseDriver->mailTemplateRepository()->delete($templateID);
    }

    public function listMailSendingHandlers(): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->all();
    }

    public function getMailSendingHandler(string $mailSendingHandlerID): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->get($mailSendingHandlerID);
    }

    public function addMailSendingHandler(array $mailSendingHandler): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->create($mailSendingHandler);
    }

    public function updateMailSendingHandler(string $mailSendingHandlerID, array $mailSendingHandler): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->update($mailSendingHandlerID, $mailSendingHandler);
    }

    public function deleteMailSendingHandler(string $mailSendingHandlerID): bool
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->delete($mailSendingHandlerID);
    }

    public function getMailSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->getByHandlerID($handlerID);
    }
}