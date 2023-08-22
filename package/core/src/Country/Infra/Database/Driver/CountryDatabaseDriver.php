<?php

namespace Epush\Core\Country\Infra\Database\Driver;

use Epush\Core\Country\Infra\Database\Repository\Contract\CountryRepositoryContract;

class CountryDatabaseDriver implements CountryDatabaseDriverContract
{
    public function __construct(

        private CountryRepositoryContract $countryRepository

    ) {}

    public function countryRepository(): CountryRepositoryContract
    {
        return $this->countryRepository;
    }
}