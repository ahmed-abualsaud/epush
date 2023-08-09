<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\Domain\DTO\AddAdminDto;
use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddAdminUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddAdminDto $addAdminDto): array
    {
        $this->validationService->validate($addAdminDto->toArray(), AddAdminDto::rules());
        return $this->adminService->add($addAdminDto->getAdmin(), $addAdminDto->getUser());
    }
}