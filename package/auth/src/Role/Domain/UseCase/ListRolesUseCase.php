<?php

namespace Epush\Auth\Role\Domain\UseCase;

use Epush\Auth\Role\Domain\DTO\ListRolesDto;
use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListRolesUseCase
{
    public function __construct(

        private RoleServiceContract $roleService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListRolesDto $listRolesDto): array
    {
        $this->validationService->validate($listRolesDto->toArray(), ListRolesDto::rules());
        return $this->roleService->listRoles($listRolesDto->getPageSize());
    }
}