<?php

namespace Epush\SMS\App\Contract;

interface SMSServiceContract
{
    public function listSMSTemplates(string|null $userID): array;

    public function getSMSTemplate(string $templateID): array;

    public function addSMSTemplate(array $template): array;

    public function updateSMSTemplate(string $templateID, array $template): array;
    
    public function deleteSMSTemplate(string $templateID): bool;

    public function listSMSSendingHandlers(int $take): array;

    public function getSMSSendingHandler(string $smsSendingHandlerID): array;

    public function addSMSSendingHandler(array $smsSendingHandler): array;

    public function updateSMSSendingHandler(string $smsSendingHandlerID, array $smsSendingHandler): array;

    public function deleteSMSSendingHandler(string $smsSendingHandlerID): bool;

    public function checkAndSendSMS(array $handler, mixed $request, mixed $response): void;

    public function getSMSSendingHandlerByHandlerID(string $handlerID): array;

    public function getSMSSendingHandlersByHandlersID(array $handlersID, int $take): array;

    public function searchSMSSendingHandlerColumn(string $column, string $value, int $take = 10): array;
}