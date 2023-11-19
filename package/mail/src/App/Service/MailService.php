<?php

namespace Epush\Mail\App\Service;

use Epush\Mail\Infra\Driver\MailDriverContract;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\App\Contract\MailDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MailService implements MailServiceContract
{
    public function __construct(

        private MailDriverContract $mailDriver,
        private MailDatabaseServiceContract $mailDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}

    public function listMailTemplates(): array
    {
        return $this->mailDatabaseService->listMailTemplates();
    }

    public function getMailTemplate(string $templateID): array
    {
        return $this->mailDatabaseService->getMailTemplate($templateID);
    }

    public function addMailTemplate(array $template): array
    {
        return $this->mailDatabaseService->addMailTemplate($template);
    }

    public function updateMailTemplate(string $templateID, array $template): array
    {
        return $this->mailDatabaseService->updateMailTemplate($templateID, $template);
    }
    
    public function deleteMailTemplate(string $templateID): bool
    {
        return $this->mailDatabaseService->deleteMailTemplate($templateID);
    }

    public function listMailSendingHandlers(int $take): array
    {
        $sendingHandlers = $this->mailDatabaseService->listMailSendingHandlers($take);
        $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
        $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
        $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
        return $sendingHandlers;
    }

    public function getMailSendingHandler(string $mailSendingHandlerID): array
    {
        $sendingHandler = $this->mailDatabaseService->getMailSendingHandler($mailSendingHandlerID);
        $sendingHandler['handler'] = $this->communicationEngine->broadcast("orchi:handler:get-handler-by-id", $sendingHandler['id'])[0];
        return $sendingHandler;
    }

    public function addMailSendingHandler(array $mailSendingHandler): array
    {
        return $this->mailDatabaseService->addMailSendingHandler($mailSendingHandler);
    }

    public function updateMailSendingHandler(string $mailSendingHandlerID, array $mailSendingHandler): array
    {
        return $this->mailDatabaseService->updateMailSendingHandler($mailSendingHandlerID, $mailSendingHandler);
    }

    public function deleteMailSendingHandler(string $mailSendingHandlerID): bool
    {
        return $this->mailDatabaseService->deleteMailSendingHandler($mailSendingHandlerID);
    }

    public function getMailSendingHandlerByHandlerID(string $handlerID): array
    {
        return $this->mailDatabaseService->getMailSendingHandlerByHandlerID($handlerID);
    }

    public function getMailSendingHandlersByHandlersID(array $handlersID, int $take): array
    {
        return $this->mailDatabaseService->getMailSendingHandlersByHandlersID($handlersID, $take);
    }

    public function searchMailSendingHandlerColumn(string $column, string $value, int $take = 10): array
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
                $sendingHandlers = $this->getMailSendingHandlersByHandlersID($handlersID, $take);
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers['data'], 'handler_id');
                return $sendingHandlers;
                break;

            default:
                $sendingHandlers = $this->mailDatabaseService->searchMailSendingHandlerColumn($column, $value, $take);
                $handlersID = array_unique(array_column($sendingHandlers['data'], 'handler_id'));
                $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];
                $sendingHandlers['data'] = tableWith($sendingHandlers['data'], $handlers, 'handler_id', 'handler_id');
                return $sendingHandlers;
                break;
        }
    }

    public function sendMail(string $email, string $subject, string $content): void
    {
        $this->mailDriver->sendMail($email, $subject, $content);
    }

    public function checkAndSendMail(array $handler, mixed $request, mixed $response): void
    {
        if ($response->getStatusCode() === 200) {

            $this->updateResponseAttributesKeys($response, $handler);
            $mailSendingHandler = $this->getMailSendingHandlerByHandlerID($handler['id']);

            if (empty($mailSendingHandler)) {
                return;
            }

            $mailTemplate = $this->getMailTemplate($mailSendingHandler['mail_template_id']);
            $templateKeys = array_merge(getMessageTemplateKeys($mailTemplate['template']), ["email"]);
            $attributes = $this->getMailTemplateAttributesValuesFromResponse($response, $templateKeys);
            $mailContent = $mailTemplate['template'];

            if (! empty($templateKeys)) {
                $mailContent = replaceTemplateKeys($mailTemplate['template'], $attributes);
            }

            $email = ! empty($mailSendingHandler['email']) ? $mailSendingHandler['email'] : ((array_key_exists("email", $attributes) && ! empty($attributes['email'])) ? $attributes['email'] : null);

            if (! empty($email)) {
                $this->mailDriver->sendMail($email, $mailTemplate['subject'], $mailContent);
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

    private function getMailTemplateAttributesValuesFromResponse(mixed $response, array $templateKeys)
    {
        $results = [];
        getSubArrayRecursively(getResponseData($response->original), $templateKeys, $results);
        return $results;
    }
}