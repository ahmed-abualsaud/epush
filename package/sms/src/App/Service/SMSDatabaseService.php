<?php

namespace Epush\SMS\App\Service;

use Epush\SMS\App\Contract\SMSDatabaseServiceContract;
use Epush\SMS\Infra\Database\Driver\SMSDatabaseDriverContract;

class SMSDatabaseService implements SMSDatabaseServiceContract
{
    public function __construct(

        private SMSDatabaseDriverContract $smsDatabaseDriver

    ) {}

    public function listSMSTemplates(): array
    {
        return $this->smsDatabaseDriver->smsTemplateRepository()->all();
    }

    public function getSMSTemplate(string $templateID): array
    {
        return $this->smsDatabaseDriver->smsTemplateRepository()->get($templateID);
    }

    public function addSMSTemplate(array $template): array
    {
        return $this->smsDatabaseDriver->smsTemplateRepository()->create($template);
    }

    public function updateSMSTemplate(string $templateID, array $template): array
    {
        return $this->smsDatabaseDriver->smsTemplateRepository()->update($templateID, $template);
    }
    
    public function deleteSMSTemplate(string $templateID): bool
    {
        return $this->smsDatabaseDriver->smsTemplateRepository()->delete($templateID);
    }

    public function listSMSSendingHandlers(int $take): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->paginate($take);
    }

    public function getSMSSendingHandler(string $smsSendingHandlerID): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->get($smsSendingHandlerID);
    }

    public function addSMSSendingHandler(array $smsSendingHandler): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->create($smsSendingHandler);
    }

    public function updateSMSSendingHandler(string $smsSendingHandlerID, array $smsSendingHandler): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->update($smsSendingHandlerID, $smsSendingHandler);
    }

    public function deleteSMSSendingHandler(string $smsSendingHandlerID): bool
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->delete($smsSendingHandlerID);
    }

    public function getSMSSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->getByHandlerID($handlerID);
    }

    public function getSMSSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->getByHandlersID($handlersID, $take);
    }

    public function searchSMSSendingHandlerColumn(string $column, string $value, int $take = 10): array
    {
        return $this->smsDatabaseDriver->smsSendingHandlerRepository()->searchColumn($column, $value, $take);
    }
}