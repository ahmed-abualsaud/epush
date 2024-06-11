<?php

namespace Epush\Core\Partner\Infra\Database\Repository\Contract;

interface PartnerRepositoryContract
{
    public function all(int $take): array;

    public function get(string $userID): array;

    public function create(array $partner): array;

    public function update(string $userID, array $partner): array;

    public function delete(string $id): bool;

    public function getPartners(array $usersID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}