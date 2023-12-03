<?php

namespace Epush\Core\Admin\App\Service;


use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Core\Admin\App\Contract\AdminDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class AdminService implements AdminServiceContract
{
    public function __construct(

        private AdminDatabaseServiceContract $adminDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}


    public function list(int $take): array
    {
        $admins = $this->adminDatabaseService->paginateAdmins($take);
        $usersID = array_column($admins['data'], 'user_id');
        $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
        $admins['data'] = tableWith($admins['data'], $users, "user_id");
        return $admins;
    }

    public function get(string $userID): array
    {
        $admin = $this->adminDatabaseService->getAdmin($userID);
        $user = $this->communicationEngine->broadcast("auth:user:get-user", $userID)[0];
        $result =  array_replace_recursive($user, $admin);
        $result['id'] = $userID;
        $result['admin_id'] = $admin['id'] ?? null;
        return $result;
    }


    public function add(array $admin, array $user): array
    {
        $user = $this->communicationEngine->broadcast("auth:user:add-user", $user, 'admin')[0];
        $admin['user_id'] = $user['id'];
        $admin = $this->adminDatabaseService->addAdmin($admin);

        $result =  array_replace_recursive($user, $admin);
        $result['id'] = $admin['user_id'];
        $result['admin_id'] = $admin['id'];
        return $result;
    }

    public function update(string $userID, array $admin, array $user): array
    {
        $user = $this->communicationEngine->broadcast("auth:user:update-user", $userID, $user)[0];
        $admin = $this->adminDatabaseService->updateAdmin($userID, $admin);
        return tableWith([$admin], [$user], "user_id")[0];
    }

    public function delete(string $userID): bool
    {
        return $this->adminDatabaseService->deleteAdmin($userID) && $this->communicationEngine->broadcast("auth:user:delete-user", $userID)[0];
    }

    public function searchColumn(string $column, string $value, bool $searchAdmin = true, int $take = 10): array
    {
        if ($searchAdmin) {
            $admins = $this->adminDatabaseService->searchAdminColumn($column, $value, $take);
            $usersID = array_column($admins['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
            $admins['data'] = tableWith($admins['data'], $users, "user_id");
            return $admins;
        } else {
            $admins = $this->adminDatabaseService->paginateAdmins(1000000000000);
            $usersID = array_column($admins['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:search-column", $column, $value, $take, $usersID)[0];
            $usersID = array_column($users['data'], 'id');
            $admins = $this->adminDatabaseService->getAdmins($usersID);
            $users['data'] = tableWith($admins, $users['data'], "user_id");
            return $users;
        }

    }
}