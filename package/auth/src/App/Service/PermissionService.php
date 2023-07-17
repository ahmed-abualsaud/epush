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
}