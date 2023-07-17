<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\ListRolesDto;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListRolesUseCase
{
    public function __construct(

        private PermissionServiceContract $permissionService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListRolesDto $listRolesDto): array
    {
        $this->validationService->validate($listRolesDto->toArray(), ListRolesDto::rules());
        return $this->permissionService->listRoles($listRolesDto->getPageSize());
    }
}