<?php

namespace Epush\Core\Admin\App\Service;


use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Core\Admin\App\Contract\AdminDatabaseServiceContract;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Shared\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\MailServiceContract;

class AdminService implements AdminServiceContract
{
    public function __construct(

        private SMSServiceContract $smsService,
        private MailServiceContract $mailService,
        private FileServiceContract $fileService,
        private AuthServiceContract $authService,
        private AdminDatabaseServiceContract $adminDatabaseService

    ) {}


    public function list(int $take): array
    {
        $admins = $this->adminDatabaseService->paginateAdmins($take);
        $usersID = array_column($admins['data'], 'user_id');
        $users = $this->authService->getUsers($usersID);
        $admins['data'] = innerJoinTableArraysOnColumns($users, $admins['data'], "id", "user_id");
        return $admins;
    }

    public function get(string $userID): array
    {
        $admin = $this->adminDatabaseService->getAdmin($userID);
        $user = $this->authService->getUser($userID);
        $result =  array_replace_recursive($user, $admin);
        $result['id'] = $userID;
        $result['admin_id'] = $admin['id'] ?? null;
        return $result;
    }


    public function add(array $admin, array $user): array
    {
        $user = $this->authService->addUser($user, 'admin');
        $password = $this->authService->generatePassword($user['id']);

        $admin['user_id'] = $user['id'];
        $admin = $this->adminDatabaseService->addAdmin($admin);

        $this->smsService->sendMessage($user['phone'], 'Your password is: '.$password);
        $this->mailService->sendClientAddedMail($user['email'], $user);

        $result =  array_replace_recursive($user, $admin);
        $result['id'] = $admin['user_id'];
        $result['admin_id'] = $admin['id'];
        return $result;
    }

    public function update(string $userID, array $admin, array $user): array
    {
        $user = $this->authService->updateUser($userID, $user);
        $admin = $this->adminDatabaseService->updateAdmin($userID, $admin);
        return innerJoinTableArraysOnColumns([$user], [$admin], "id", "user_id")[0];
    }

    public function delete(string $userID): bool
    {
        return $this->adminDatabaseService->deleteAdmin($userID) && $this->authService->deleteUser($userID);
    }

    public function searchColumn(string $column, string $value, bool $searchAdmin = true, int $take = 10): array
    {
        if ($searchAdmin) {
            $admins = $this->adminDatabaseService->searchAdminColumn($column, $value, $take);
            $usersID = array_column($admins['data'], 'user_id');
            $users = $this->authService->getUsers($usersID);
            $admins['data'] = innerJoinTableArraysOnColumns($users, $admins['data'], "id", "user_id");
            return $admins;
        } else {
            $admins = $this->adminDatabaseService->paginateAdmins(1000000000000);
            $usersID = array_column($admins['data'], 'user_id');
            $users = $this->authService->searchUserColumn($column, $value, $take, $usersID);
            $usersID = array_column($users['data'], 'id');
            $admins = $this->adminDatabaseService->getAdmins($usersID);
            $users['data'] = innerJoinTableArraysOnColumns($users['data'], $admins, "id", "user_id");
            return $users;
        }

    }
}