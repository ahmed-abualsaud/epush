<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\Domain\DTO\ListAdminsDto;
use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListAdminsUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListAdminsDto $listAdminsDto): array
    {
        $this->validationService->validate($listAdminsDto->toArray(), ListAdminsDto::rules());
        return $this->adminService->list($listAdminsDto->getPageSize());
    }
}