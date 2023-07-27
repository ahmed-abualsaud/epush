<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\PermissionDto;
use Epush\Auth\Domain\DTO\UpdatePermissionDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
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