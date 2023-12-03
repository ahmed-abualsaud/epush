<?php

namespace Epush\Auth\Permission\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;


use Epush\Auth\Permission\Domain\DTO\PermissionDto;
use Epush\Auth\Permission\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Permission\Domain\DTO\UpdatePermissionDto;

use Epush\Auth\Permission\Domain\UseCase\ListPermissionsUseCase;
use Epush\Auth\Permission\Domain\UseCase\DeletePermissionUseCase;
use Epush\Auth\Permission\Domain\UseCase\UpdatePermissionUseCase;

#[Prefix('api/auth/permission')]
class PermissionController
{
    #[Get('/')]
    public function listPermissions(ListPermissionsDto $listPermissionsDto, ListPermissionsUseCase $listPermissionsUseCase): Response
    {
        return jsonResponse($listPermissionsUseCase->execute($listPermissionsDto));
    }

    #[Put('{permission_id}')]
    public function updtePermission(PermissionDto $permissionDto, UpdatePermissionDto $updatePermissionDto, UpdatePermissionUseCase $updatePermissionUseCase): Response
    {
        return jsonResponse($updatePermissionUseCase->execute($permissionDto, $updatePermissionDto));
    }

    #[Delete('{permission_id}')]
    public function deletePermission(PermissionDto $permissionDto, DeletePermissionUseCase $deletePermissionUseCase): Response
    {
        return jsonResponse($deletePermissionUseCase->execute($permissionDto));
    }
}