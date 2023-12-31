<?php

namespace Epush\Auth\Permission\Infra\Database\Repository\Contract;

interface PermissionRepositoryContract
{
    public function all(int $take): array;

    public function update(string $permissionID, array $data): array;

    public function delete(string $permissionID): bool;
}