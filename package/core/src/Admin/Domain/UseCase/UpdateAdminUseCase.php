<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\Domain\DTO\AdminDto;
use Epush\Core\Admin\Domain\DTO\UpdateAdminDto;
use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateAdminUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AdminDto $adminDto, UpdateAdminDto $updateAdminDto): array
    {
        $this->validationService->validate($adminDto->toArray(), AdminDto::rules());
        $this->validationService->validate($updateAdminDto->toArray(), UpdateAdminDto::rules());
        return $this->adminService->update($adminDto->getUserID(), $updateAdminDto->getAdmin(), $updateAdminDto->getUser());
    }
}