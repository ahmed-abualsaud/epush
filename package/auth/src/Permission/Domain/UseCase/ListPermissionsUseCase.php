<?php

namespace Epush\Auth\Permission\Domain\UseCase;

use Epush\Auth\Permission\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Permission\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListPermissionsUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListPermissionsDto $listPermissionsDto): array
    {
        $this->validationService->validate($listPermissionsDto->toArray(), ListPermissionsDto::rules());
        return $this->permissionService->listPermissions($listPermissionsDto->getPageSize());
    }
}