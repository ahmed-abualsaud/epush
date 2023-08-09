<?php

namespace Epush\Core\Admin\App\Service;

use Epush\Core\Admin\App\Contract\AdminDatabaseServiceContract;
use Epush\Core\Admin\Infra\Database\Driver\AdminDatabaseDriverContract;

class AdminDatabaseService implements AdminDatabaseServiceContract
{
    public function __construct(

        private AdminDatabaseDriverContract $adminDatabaseDriver

    ) {}

    public function getAdmin(string $userID): array
    {
        return $this->adminDatabaseDriver->adminRepository()->get($userID);
    }

    public function getAdmins(array $usersID): array
    {
        return $this->adminDatabaseDriver->adminRepository()->getAdmins($usersID);
    }

    public function paginateAdmins(int $take): array
    {
        return $this->adminDatabaseDriver->adminRepository()->all($take);
    }

    public function addAdmin(array $admin): array
    {
        return $this->adminDatabaseDriver->adminRepository()->create($admin);
    }

    public function updateAdmin(string $userID, array $admin): array
    {
        return $this->adminDatabaseDriver->adminRepository()->update($userID, $admin);
    }

    public function deleteAdmin(string $userID): bool
    {
        return $this->adminDatabaseDriver->adminRepository()->delete($userID);
    }

    public function searchAdminColumn(string $column, string $value, int $take = 10): array
    {
        return $this->adminDatabaseDriver->adminRepository()->searchColumn($column, $value, $take);
    }
}