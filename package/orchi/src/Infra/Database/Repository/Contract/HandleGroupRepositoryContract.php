<?php

namespace Epush\Orchi\Infra\Database\Repository\Contract;

interface HandleGroupRepositoryContract
{
    public function getContextHandleGroups(string $context_id): array;

    public function update(string $id, array $data): array;
}