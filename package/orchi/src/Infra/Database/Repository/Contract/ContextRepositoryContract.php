<?php

namespace Epush\Orchi\Infra\Database\Repository\Contract;

interface ContextRepositoryContract
{
    public function getAppServiceContexts(string $service_id): array;

    public function update(string $id, array $data): array;
}