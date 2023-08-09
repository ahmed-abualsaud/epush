<?php

namespace Epush\Core\Admin\Domain\UseCase;

use Epush\Core\Admin\Domain\DTO\SearchAdminDto;
use Epush\Core\Admin\App\Contract\AdminServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchAdminUseCase
{
    public function __construct(

        private AdminServiceContract $adminService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchAdminDto $searchAdminDto): array
    {
        $this->validationService->validate($searchAdminDto->toArray(), SearchAdminDto::rules());
        return $this->adminService->searchColumn(
            $searchAdminDto->getSearchColumn(),
            $searchAdminDto->getSearchValue(),
            $searchAdminDto->searchAdmin(),
            $searchAdminDto->getPageSize()
        );
    }
}