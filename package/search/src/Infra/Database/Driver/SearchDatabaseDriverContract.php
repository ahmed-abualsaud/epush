<?php

namespace Epush\Search\Infra\Database\Driver;

use Epush\Search\Infra\Database\Repository\Contract\SearchRepositoryContract;

interface SearchDatabaseDriverContract
{
    public function getSearchRepository(): SearchRepositoryContract;
}