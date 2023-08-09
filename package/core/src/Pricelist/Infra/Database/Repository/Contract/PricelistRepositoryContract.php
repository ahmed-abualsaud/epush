<?php

namespace Epush\Core\Pricelist\Infra\Database\Repository\Contract;

interface PricelistRepositoryContract
{
    public function all(): array;

    public function get(string $id): array;

    public function create(array $client): array;

    public function update(string $id, array $data): array;

    public function delete(string $id): bool;
}