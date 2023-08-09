<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\Domain\DTO\AdminDto;
use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetAdminUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AdminDto $adminDto): array
    {
        $this->validationService->validate($adminDto->toArray(), AdminDto::rules());
        return $this->adminService->get($adminDto->getUserID());
    }
}