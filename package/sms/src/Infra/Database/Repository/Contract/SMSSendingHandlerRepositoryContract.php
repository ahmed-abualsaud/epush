<?php

namespace Epush\SMS\Infra\Database\Repository\Contract;

interface SMSSendingHandlerRepositoryContract
{
    public function paginate(int $take): array;

    public function get(string $smsSendingHandlerID): array;

    public function create(array $smsSendingHandler): array;

    public function update(string $smsSendingHandlerID, array $smsSendingHandler): array;

    public function delete(string $smsSendingHandlerID): bool;

    public function getByHandlerID(string $handlerID): array;

    public function getByHandlersID(array $handlersID, int $take): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}