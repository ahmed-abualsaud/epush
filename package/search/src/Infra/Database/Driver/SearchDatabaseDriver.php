<?php

namespace Epush\Search\Infra\Database\Driver;

use Epush\Search\Infra\Database\Repository\Contract\SearchRepositoryContract;

class SearchDatabaseDriver implements SearchDatabaseDriverContract
{
    public function __construct(

        private SearchRepositoryContract $searchRepository

    ) {}

    public function getSearchRepository(): SearchRepositoryContract
    {
        return $this->searchRepository;
    }
}