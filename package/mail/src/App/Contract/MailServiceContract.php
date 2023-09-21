<?php

namespace Epush\Mail\App\Contract;

interface MailServiceContract
{
    public function listMailTemplates(): array;

    public function getMailTemplate(string $templateID): array;

    public function addMailTemplate(array $template): array;

    public function updateMailTemplate(string $templateID, array $template): array;
    
    public function deleteMailTemplate(string $templateID): bool;

    public function listMailSendingHandlers(): array;

    public function getMailSendingHandler(string $mailSendingHandlerID): array;

    public function addMailSendingHandler(array $mailSendingHandler): array;

    public function updateMailSendingHandler(string $mailSendingHandlerID, array $mailSendingHandler): array;
    
    public function deleteMailSendingHandler(string $mailSendingHandlerID): bool;

    public function checkAndSendMail(mixed $request, mixed $response): mixed;

    public function getMailSendingHandlerByHandlerID(string $handlerID): array;
} 