<?php

namespace Epush\Auth\Role\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;

use Epush\Auth\Role\Domain\DTO\RoleDto;
use Epush\Auth\Role\Domain\DTO\AddRoleDto;
use Epush\Auth\Role\Domain\DTO\ListRolesDto;
use Epush\Auth\Role\Domain\DTO\UpdateRoleDto;
use Epush\Auth\Role\Domain\DTO\AssignRolePermissionsDto;
use Epush\Auth\Role\Domain\DTO\UnassignRolePermissionsDto;

use Epush\Auth\Role\Domain\UseCase\AddRoleUseCase;
use Epush\Auth\Role\Domain\UseCase\ListRolesUseCase;
use Epush\Auth\Role\Domain\UseCase\UpdateRoleUseCase;
use Epush\Auth\Role\Domain\UseCase\DeleteRoleUseCase;
use Epush\Auth\Role\Domain\UseCase\GetRolePermissionsUseCase;
use Epush\Auth\Role\Domain\UseCase\AssignRolePermissionsUseCase;
use Epush\Auth\Role\Domain\UseCase\UnassignRolePermissionsUseCase;

#[Prefix('api/auth/role')]
class RoleController
{
    #[Get('/')]
    public function listRoles(ListRolesDto $listRolesDto, ListRolesUseCase $listRolesUseCase): Response
    {
        return jsonResponse($listRolesUseCase->execute($listRolesDto));
    }

    #[Post('/')]
    public function addRole(AddRoleDto $addRoleDto, AddRoleUseCase $addRoleUseCase): Response
    {
        return jsonResponse($addRoleUseCase->execute($addRoleDto));
    }

    #[Put('{role_id}')]
    public function updateRole(RoleDto $roleDto, UpdateRoleDto $updateRoleDto, UpdateRoleUseCase $updateRoleUseCase): Response
    {
        return jsonResponse($updateRoleUseCase->execute($roleDto, $updateRoleDto));
    }

    #[Delete('{role_id}')]
    public function deleteRole(RoleDto $roleDto, DeleteRoleUseCase $deleteRoleUseCase): Response
    {
        return jsonResponse($deleteRoleUseCase->execute($roleDto));
    }

    #[Get('{role_id}/permissions')]
    public function getRolePermissions(RoleDto $roleDto, GetRolePermissionsUseCase $getRolePermissionsUseCase): Response
    {
        return jsonResponse($getRolePermissionsUseCase->execute($roleDto));
    }

    #[Post('{role_id}/permissions')]
    public function assignRolePermissions(RoleDto $roleDto, AssignRolePermissionsDto $assignRolePermissionsDto, AssignRolePermissionsUseCase $assignRolePermissionsUseCase): Response
    {
        return jsonResponse($assignRolePermissionsUseCase->execute($roleDto, $assignRolePermissionsDto));
    }

    #[Put('{role_id}/permissions')]
    public function unassignRolePermissions(RoleDto $roleDto, UnassignRolePermissionsDto $unassignRolePermissionsDto, UnassignRolePermissionsUseCase $unassignRolePermissionsUseCase): Response
    {
        return jsonResponse($unassignRolePermissionsUseCase->execute($roleDto, $unassignRolePermissionsDto));
    }
}