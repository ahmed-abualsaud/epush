<?php

namespace Epush\Auth\Permission\Domain\UseCase;

use Epush\Auth\Permission\Domain\DTO\PermissionDto;
use Epush\Auth\Permission\Domain\DTO\UpdatePermissionDto;
use Epush\Auth\Permission\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdatePermissionUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PermissionDto $permissionDto, UpdatePermissionDto $updatePermissionDto): array
    {
        $this->validationService->validate($permissionDto->toArray(), PermissionDto::rules());
        $this->validationService->validate($updatePermissionDto->toArray(), UpdatePermissionDto::rules());
        return $this->permissionService->updatePermission($permissionDto->getPermissionId(), $updatePermissionDto->toArray());
    }
}