<?php

namespace Epush\Core\Admin\Infra\Database\Driver;

use Epush\Core\Admin\Infra\Database\Repository\Contract\AdminRepositoryContract;

interface AdminDatabaseDriverContract
{
    public function adminRepository(): AdminRepositoryContract;
}