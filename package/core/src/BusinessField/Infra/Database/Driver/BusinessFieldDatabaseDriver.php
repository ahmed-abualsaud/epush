<?php

namespace Epush\Core\BusinessField\Infra\Database\Driver;

use Epush\Core\BusinessField\Infra\Database\Repository\Contract\BusinessFieldRepositoryContract;

class BusinessFieldDatabaseDriver implements BusinessFieldDatabaseDriverContract
{
    public function __construct(

        private BusinessFieldRepositoryContract $businessFieldRepository

    ) {}

    public function businessFieldRepository(): BusinessFieldRepositoryContract
    {
        return $this->businessFieldRepository;
    }
}