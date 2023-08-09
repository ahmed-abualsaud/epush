<?php

namespace Epush\Core\Admin\Infra\Database\Driver;

use Epush\Core\Admin\Infra\Database\Repository\Contract\AdminRepositoryContract;

class AdminDatabaseDriver implements AdminDatabaseDriverContract
{
    public function __construct(

        private AdminRepositoryContract $adminRepository

    ) {}

    public function adminRepository(): AdminRepositoryContract
    {
        return $this->adminRepository;
    }
}