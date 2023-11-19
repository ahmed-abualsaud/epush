<?php

namespace Epush\Search\App\Contract;

interface SearchServiceContract
{
    public function search(string $entity, string $criteria, int $take = 0, int $page = 1): array;
}