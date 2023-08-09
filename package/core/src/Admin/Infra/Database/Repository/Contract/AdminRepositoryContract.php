<?php

namespace Epush\Core\Admin\Infra\Database\Repository\Contract;

interface AdminRepositoryContract
{
    public function all(int $take): array;

    public function get(string $userID): array;

    public function create(array $admin): array;

    public function update(string $userID, array $admin): array;

    public function delete(string $id): bool;

    public function getAdmins(array $usersID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}