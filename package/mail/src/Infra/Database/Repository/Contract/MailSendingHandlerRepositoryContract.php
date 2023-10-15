<?php

namespace Epush\Mail\Infra\Database\Repository\Contract;

interface MailSendingHandlerRepositoryContract
{
    public function paginate(int $take): array;

    public function get(string $mailSendingHandlerID): array;

    public function create(array $mailSendingHandler): array;

    public function update(string $mailSendingHandlerID, array $mailSendingHandler): array;

    public function delete(string $mailSendingHandlerID): bool;

    public function getByHandlerID(string $handlerID): array;

    public function getByHandlersID(array $handlersID, int $take): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}