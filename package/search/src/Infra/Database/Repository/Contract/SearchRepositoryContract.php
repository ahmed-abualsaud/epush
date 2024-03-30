<?php

namespace Epush\Search\Infra\Database\Repository\Contract;


interface SearchRepositoryContract
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