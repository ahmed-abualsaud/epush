<?php

namespace Epush\Orchi\Infra\Database\Repository\Contract;

interface HandlerRepositoryContract
{
    public function getHandleGroupHandlers(string $handle_group_id): array;

    public function update(string $id, array $data): array;

    public function getHandlers(array $handersID): array;

    public function getHandlerByEndpoint(string $endpoint): array;
}