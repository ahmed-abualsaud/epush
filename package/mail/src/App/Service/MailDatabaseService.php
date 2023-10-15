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

    public function listMailSendingHandlers(int $take): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->paginate($take);
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

    public function getMailSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->getByHandlersID($handlersID, $take);
    }

    public function searchMailSendingHandlerColumn(string $column, string $value, int $take = 10): array
    {
        return $this->mailDatabaseDriver->mailSendingHandlerRepository()->searchColumn($column, $value, $take);
    }
}