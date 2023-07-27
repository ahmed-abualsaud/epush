<?php

namespace Epush\Auth\App\Service;

use Epush\Shared\App\Contract\OrchiServiceContract;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Auth\App\Contract\AuthDatabaseServiceContract;

class PermissionService implements PermissionServiceContract
{
    public function __construct(

        private OrchiServiceContract $orchiService,
        private AuthDatabaseServiceContract $authDatabaseService

    ) {}

    public function listRoles(int $take): array
    {
        return $this->authDatabaseService->paginateRoles($take);
    }

    public function listPermissions(int $take): array
    {
        return $this->authDatabaseService->paginatePermissions($take);
    }

    public function getUserRoles(string $userID): array
    {
        return $this->authDatabaseService->getUserRoles($userID);
    }

    public function getUserPermissions(string $userID): array
    {
        return $this->authDatabaseService->getUserPermissions($userID);
    }

    public function getAllUserPermissions(string $userID): array
    {
        $permissions = $this->authDatabaseService->getAllUserPermissions($userID);
        if (empty($permissions)) { return []; }

        $handlersID = array_column($permissions, 'handler_id');
        $handlers = $this->orchiService->getHandlers($handlersID);

        $detailedPermissions = innerJoinTableArrays($permissions, $handlers, 'handler_id');

        // $detailedPermissions = andWhereTableArray($detailedPermissions, [
        //     'context_online' => true,
        //     'handler_enabled' => true
        // ]);
        return $detailedPermissions;
    }

    public function getRolePermissions(string $roleID): array
    {
        return $this->authDatabaseService->getRolePermissions($roleID);
    }

    public function assignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->authDatabaseService->assignUserRoles($userID, $rolesID);
    }

    public function assignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->authDatabaseService->assignUserPermissions($userID, $permissionsID);
    }

    public function unassignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->authDatabaseService->unassignUserRoles($userID, $rolesID);
    }

    public function unassignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->authDatabaseService->unassignUserPermissions($userID, $permissionsID);
    }

    public function addRole(array $data): array
    {
        return $this->authDatabaseService->addRole($data);
    }

    public function updateRole(string $roleID, array $data): array
    {
        return $this->authDatabaseService->updateRole($roleID, $data);
    }

    public function deleteRole(string $roleID): bool
    {
        return $this->authDatabaseService->deleteRole($roleID);
    }

    public function updatePermission(string $permissionID, array $data): array
    {
        return $this->authDatabaseService->updatePermission($permissionID, $data);
    }

    public function deletePermission(string $permissionID): bool
    {
        return $this->authDatabaseService->deletePermission($permissionID);
    }

    public function assignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->authDatabaseService->assignRolePermissions($roleID, $permissionsID);
    }

    public function unassignRolePermissions(string $roleID, array $permissionsID): bool
    {
        return $this->authDatabaseService->unassignRolePermissions($roleID, $permissionsID);
    }
}