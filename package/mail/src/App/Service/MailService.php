<?php

namespace Epush\Mail\App\Service;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\App\Contract\MailDatabaseServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class MailService implements MailServiceContract
{
    public function __construct(

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

    public function listMailSendingHandlers(): array
    {
        return $this->mailDatabaseService->listMailSendingHandlers();
    }

    public function getMailSendingHandler(string $mailSendingHandlerID): array
    {
        return $this->mailDatabaseService->getMailSendingHandler($mailSendingHandlerID);
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

    public function checkAndSendMail(mixed $request, mixed $response): mixed
    {
        if ($response->getStatusCode() === 200) {

            $url = $request->url();
            $method = $request->method();

            $handler = $this->communicationEngine->broadcast("orchi:handler:get-handler-by-endpoint", $method . "|" . $url)[0];
            $mailSendingHandler = $this->getMailSendingHandlerByHandlerID($handler['id']);

            // $results = [];
            // getSubArrayRecursively(getResponseData($response->original), config("mail-user_data_keys"), $results);
            // return successJSONResponse($results);

            // if (empty($mailSendingHandler)) {
            //     return $response;
            // }

            // if ($handler['access_user']) {
            //     $results = [];
            //     getSubArrayRecursively(getResponseData($response->original), config("mail-user_data_keys"), $results);
            //     return successJSONResponse($results);
            // }
        }

        return $response;
    }
}