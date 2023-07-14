<?php

namespace Epush\Orchi\Infra\Database\Repository\Contract;

interface AppServiceRepositoryContract
{
    public function all(): array;

    public function update(string $id, array $data): array;

    public function getLocalServices(): array;

    public function getRemoteServices(): array;
}