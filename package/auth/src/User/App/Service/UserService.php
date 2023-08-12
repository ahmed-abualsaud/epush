<?php

namespace Epush\Auth\User\App\Service;

use Epush\Shared\App\Contract\OrchiServiceContract;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;

use Epush\Shared\App\Contract\FileServiceContract;

class UserService implements UserServiceContract
{
    public function __construct(

        
        private RoleServiceContract $roleService,
        private FileServiceContract $fileService,
        private OrchiServiceContract $orchiService,
        private CredentialsServiceContract $credentialsService,
        private UserDatabaseServiceContract $userDatabaseService

    ) {}

    public function get(string $userID): array
    {
        return $this->userDatabaseService->getUser($userID);
    }


    public function list(int $take): array
    {
        return $this->userDatabaseService->paginateUsers($take);
    }


    public function getUsers(array $usersID): array
    {
        return $this->userDatabaseService->getUsers($usersID);
    }


    public function update(string $userID ,array $data): array
    {
        $updatedUser = $this->userDatabaseService->updateUserByID($userID, $data);
        array_key_exists("avatar", $data) && $data['avatar'] && $avatar = $this->fileService->localStore('avatar', $updatedUser['username'].'-avatar', 'avatars');
        ! empty($avatar) && $updatedUser = $this->userDatabaseService->updateUserByID($userID, ['avatar' => $avatar]);
        return $updatedUser;
    }


    public function signup(array $data, string $roleName = null): array
    {   
        $avatar = $this->fileService->localStore('avatar', $data['username'].'-avatar', 'avatars');
        $avatar && $data['avatar'] = $avatar;

        $data['password'] = $this->credentialsService->hashPassword($data['password']);
        $user = $this->userDatabaseService->addUser($data);

        ! empty($roleName) && $this->userDatabaseService->assignUserRole($user['id'], $roleName);

        return $user;
    }


    public function delete(string $userID): bool
    {
        $user = $this->userDatabaseService->getUser($userID);
        $user['avatar'] && $this->fileService->deleteLocalFile($user['avatar'], 'avatars');
        return $this->userDatabaseService->deleteUser($userID);
    }

    public function getUserRoles(string $userID): array
    {
        return $this->userDatabaseService->getUserRoles($userID);
    }

    public function getUserPermissions(string $userID): array
    {
        return $this->userDatabaseService->getUserPermissions($userID);
    }

    public function getAllUserPermissions(string $userID): array
    {
        $roles = $this->userDatabaseService->getUserRoles($userID);
        if (empty($roles)) { return []; }

        $userRolesID = array_column($roles, 'id');
        $permissions = $this->roleService->getRolesPermissions($userRolesID);

        $handlersID = array_column($permissions, 'handler_id');
        $handlers = $this->orchiService->getHandlers($handlersID);

        $detailedPermissions = innerJoinTableArrays($permissions, $handlers, 'handler_id');
        return $detailedPermissions;
    }

    public function assignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseService->assignUserRoles($userID, $rolesID);
    }

    public function assignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseService->assignUserPermissions($userID, $permissionsID);
    }

    public function unassignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseService->unassignUserRoles($userID, $rolesID);
    }

    public function unassignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseService->unassignUserPermissions($userID, $permissionsID);
    }
    
    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->userDatabaseService->checkUserEnabledOrFail($userName);
    }

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return $this->userDatabaseService->searchUserColumn($column, $value, $take, $usersID);
    }
}