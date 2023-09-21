<?php

namespace Epush\Mail\Infra\Database\Repository\Contract;

interface MailSendingHandlerRepositoryContract
{
    public function all(): array;

    public function get(string $mailSendingHandlerID): array;

    public function create(array $mailSendingHandler): array;

    public function update(string $mailSendingHandlerID, array $mailSendingHandler): array;

    public function delete(string $mailSendingHandlerID): bool;

    public function getByHandlerID(string $handlerID): array;
}