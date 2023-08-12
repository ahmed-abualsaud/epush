<?php

namespace Epush\Auth\Permission\Domain\UseCase;

use Epush\Auth\Permission\Domain\DTO\PermissionDto;
use Epush\Auth\Permission\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeletePermissionUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PermissionDto $permissionDto): bool
    {
        $this->validationService->validate($permissionDto->toArray(), PermissionDto::rules());
        return $this->permissionService->deletePermission($permissionDto->getPermissionId());
    }
}