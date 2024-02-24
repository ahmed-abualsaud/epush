<?php

namespace Epush\SMS\App\Service;

use Epush\SMS\Infra\Driver\SMSDriverContract;
use Epush\SMS\App\Contract\SMSServiceContract;
use Epush\SMS\App\Contract\SMSDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Core\Client\App\Contract\ClientServiceContract;
use Epush\Core\Sender\App\Contract\SenderServiceContract;
use Epush\Core\Message\App\Contract\MessageServiceContract;
use Exception;
use Illuminate\Support\Facades\Log;

class SMSService implements SMSServiceContract
{
    public function __construct(

        private SMSDriverContract $smsDriver,
        private SMSDatabaseServiceContract $smsDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}

    public function listSMSTemplates(string|null $userID): array
    {
        return $this->smsDatabaseService->listSMSTemplates($userID);
    }

    public function getSMSTemplate(string $templateID): array
    {
        return $this->smsDatabaseService->getSMSTemplate($templateID);
    }

    public function addSMSTemplate(array $template): array
    {
        return $this->smsDatabaseService->addSMSTemplate($template);
    }

    public function updateSMSTemplate(string $templateID, array $template): array
    {
        return $this->smsDatabaseService->updateSMSTemplate($templateID, $template);
    }
    
    public function deleteSMSTemplate(string $templateID): bool
    {
        return $this->smsDatabaseService->deleteSMSTemplate($templateID);
    }

    public function listSMSSendingHandlers(int $take): array
    {
        $sendingHandlers = $this->smsDatabaseService->listSMSSendingHandlers($take);
        $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
        $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
        $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
        return $sendingHandlers;
    }

    public function getSMSSendingHandler(string $smsSendingHandlerID): array
    {
        $sendingHandler = $this->smsDatabaseService->getSMSSendingHandler($smsSendingHandlerID);
        $sendingHandler['handler'] = $this->communicationEngine->broadcast("orchi:handler:get-handler-by-id", $sendingHandler['id'])[0];
        return $sendingHandler;
    }

    public function addSMSSendingHandler(array $smsSendingHandler): array
    {
        return $this->smsDatabaseService->addSMSSendingHandler($smsSendingHandler);
    }

    public function updateSMSSendingHandler(string $smsSendingHandlerID, array $smsSendingHandler): array
    {
        return $this->smsDatabaseService->updateSMSSendingHandler($smsSendingHandlerID, $smsSendingHandler);
    }

    public function deleteSMSSendingHandler(string $smsSendingHandlerID): bool
    {
        return $this->smsDatabaseService->deleteSMSSendingHandler($smsSendingHandlerID);
    }

    public function getSMSSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->smsDatabaseService->getSMSSendingHandlerByHandlerID($handlerID);
    }

    public function getSMSSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->smsDatabaseService->getSMSSendingHandlersByHandlersID($handlersID, $take);
    }

    public function searchSMSSendingHandlerColumn(string $column, string $value, int $take = 10): array
    {
        switch ($column) {
            case 'endpoint':
            case 'description':
            case 'handler_name':
            case 'handler_endpoint':
            case 'handler_description':
                $column = strpos($column, "handler") !== false ? explode("_", $column)[1] : $column;
                $handlers = $this->communicationEngine->broadcast("orchi:handler:search-column", $column, $value, 1000000000000)[0];
                $handlersID = array_column($handlers['data'], 'id');
                $sendingHandlers = $this->getSMSSendingHandlersByHandlersID($handlersID, $take);
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers['data'], 'handler_id');
                return $sendingHandlers;
                break;

            default:
                $sendingHandlers = $this->smsDatabaseService->searchSMSSendingHandlerColumn($column, $value, $take);
                $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
                $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
                return $sendingHandlers;
                break;
        }
    }

    public function checkAndSendSMS(array $handler, mixed $request, mixed $response): void
    {
        if ($response->getStatusCode() === 200) {

            $this->updateResponseAttributesKeys($response, $handler);
            $smsSendingHandler = $this->getSMSSendingHandlerByHandlerID($handler['id']);

            if (empty($smsSendingHandler)) {
                return;
            }

            $smsTemplate = $this->getSMSTemplate($smsSendingHandler['sms_template_id']);
            $templateKeys = array_merge(getMessageTemplateKeys($smsTemplate['template']), ["phone"]);
            $attributes = $this->getSMSTemplateAttributesValuesFromResponse($response, $templateKeys);
            $smsContent = $smsTemplate['template'];

            if (! empty($templateKeys)) {
                $smsContent = replaceTemplateKeys($smsTemplate['template'], $attributes);
            }

            $phone = ! empty($smsSendingHandler['phone']) ? $smsSendingHandler['phone'] : ((array_key_exists("phone", $attributes) && ! empty($attributes['phone'])) ? $attributes['phone'] : null);

            if (! empty($phone)) {
                $superAdmin = app(UserServiceContract::class)->getUserByUsername(config('auth.super_admin_username'));
                $sender = app(SenderServiceContract::class)->getSendersByUsersID([$superAdmin['id']])['data'][0];
                $client = app(ClientServiceContract::class)->get($superAdmin['id']);

                $inputs = [
                    'api_key' => $client['api_key'],
                    'sender' => $sender['name'],
                    'message' => $smsTemplate['subject'].', '.$smsContent,
                    'numbers' => [$phone],
                    'language' => 'English'
                ];
                try{
                    Log::info(json_encode(app(MessageServiceContract::class)->sendMessage($inputs)));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
    }

    private function updateResponseAttributesKeys(mixed $response, array $handler): void
    {
        if (! property_exists($response, "original") || ! is_array($response->original['data'])) {
            return;
        }

        $savedResponseKeys = $this->communicationEngine->broadcast("cache:get", $handler['endpoint'])[0];
        $responseKeys = getArrayKeys(getResponseData($response->original));
        $currentResponseKeys = implode(",", array_unique(array_filter($responseKeys, fn ($key) => is_string($key) && $key !== "id")));

        if ($savedResponseKeys !== $currentResponseKeys)
        {
            $handler = $this->communicationEngine->broadcast("orchi:handler:update", $handler['id'], ['response_attributes' => $currentResponseKeys])[0];
            ! empty($handler) && $this->communicationEngine->broadcast("cache:add", $handler['endpoint'], $currentResponseKeys)[0];
        }
    }

    private function getSMSTemplateAttributesValuesFromResponse(mixed $response, array $templateKeys)
    {
        $results = [];
        getSubArrayRecursively(getResponseData($response->original), $templateKeys, $results);
        return $results;
    }
}