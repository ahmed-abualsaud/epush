<?php

namespace Epush\Core\Admin\App\Contract;

interface AdminDatabaseServiceContract
{
    public function getAdmin(string $userID): array;

    public function getAdmins(array $usersID): array;

    public function addAdmin(array $admin): array;

    public function deleteAdmin(string $userID): bool;

    public function updateAdmin(string $userID, array $admin): array;

    public function paginateAdmins(int $take): array;

    public function searchAdminColumn(string $column, string $value, int $take = 10): array;
}