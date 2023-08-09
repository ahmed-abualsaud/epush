<?php

namespace Epush\Core\Admin\App\Contract;

interface AdminServiceContract
{
    public function list(int $take): array;

    public function get(string $userID): array;

    public function add(array $admin, array $user): array;

    public function update(string $userID, array $admin, array $user): array;

    public function delete(string $userID): bool;

    public function searchColumn(string $column, string $value, bool $searchAdmin = true, int $take = 10): array;
}