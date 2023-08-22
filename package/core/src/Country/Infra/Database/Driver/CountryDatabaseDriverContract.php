<?php

namespace Epush\Core\Country\Infra\Database\Driver;

use Epush\Core\Country\Infra\Database\Repository\Contract\CountryRepositoryContract;

interface CountryDatabaseDriverContract
{
    public function countryRepository(): CountryRepositoryContract;
}