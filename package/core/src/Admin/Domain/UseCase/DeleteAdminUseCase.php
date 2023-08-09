<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Core\Admin\Domain\DTO\AdminDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteAdminUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AdminDto $adminDto): bool
    {
        $this->validationService->validate($adminDto->toArray(), AdminDto::rules());
        return $this->adminService->delete($adminDto->getUserID());
    }
}