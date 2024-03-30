<?php

namespace Epush\Search\App\Service;

use Epush\Search\App\Contract\SearchDatabaseServiceContract;
use Epush\Search\Infra\Database\Driver\SearchDatabaseDriverContract;

class SearchDatabaseService implements SearchDatabaseServiceContract
{
    public function __construct(

        private SearchDatabaseDriverContract $searchDatabaseDriver

    ) {}

    public function search(string $criteria, string $model, array $selectAs = null, array $joins = null, array $withs = null, array $orderBy = null, int $perPage = 10, int $currentPage = 1): array
    {
        return $this->searchDatabaseDriver->getSearchRepository()->search($criteria, $model, $selectAs, $joins, $withs, $orderBy, $perPage, $currentPage);
    }
}