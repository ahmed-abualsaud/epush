<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\PermissionDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
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