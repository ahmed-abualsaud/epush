<?php

namespace Epush\Search\App\Contract;

interface SearchDatabaseServiceContract
{
    public function search(
        string $criteria,
        string $model,
        array $selectAs = null,
        array $joins = null,
        array $withs = null,
        array $orderBy = null,
        int $perPage = 10,
        int $currentPage = 1
    ): array;
}