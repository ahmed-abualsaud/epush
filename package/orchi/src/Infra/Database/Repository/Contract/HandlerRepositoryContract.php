<?php

namespace Epush\Orchi\Infra\Database\Repository\Contract;

interface HandlerRepositoryContract
{
    public function paginate(int $take = 10): array;

    public function getHandler(string $handlerID): array;

    public function getHandleGroupHandlers(string $handle_group_id): array;

    public function update(string $id, array $data): array;

    public function getHandlers(array $handersID): array;

    public function getHandlerByEndpoint(string $endpoint): array;

    public function getAllHandlersResponseAttributes(): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}