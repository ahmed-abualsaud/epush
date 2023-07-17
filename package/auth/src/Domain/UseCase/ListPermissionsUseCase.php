<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\ListPermissionsDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
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