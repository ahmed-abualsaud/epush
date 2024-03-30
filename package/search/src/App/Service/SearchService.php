<?php

namespace Epush\Search\App\Service;

use Epush\Search\App\Contract\SearchDatabaseServiceContract;
use Epush\Search\App\Contract\SearchServiceContract;

class SearchService implements SearchServiceContract
{
    private array $config;

    public function __construct(

        private SearchDatabaseServiceContract $searchDatabaseService

    ) {
        $this->config = config('search');
    }

    public function search(string $entity, string $criteria, int $take = 0, int $page = 1): array
    {
        $metadata = $this->getCriteriaParametersMetadata($entity);
        $criteria = $this->prepareCriteria($criteria, $metadata);
        return $this->searchDatabaseService->search(
            $criteria,
            $metadata['model'],
            $metadata['select_as'] ?? null,
            $metadata['joins'] ?? null,
            $metadata['withs'] ?? null,
            $metadata['OrderBy'] ?? null,
            $take, 
            $page
        );
    }

    private function prepareCriteria(string $criteria,  array $metadata): string
    {
        if (empty($metadata)) {
            throwHttpException(400, "Invalid criteria parameters");
        }

        $criteria = " ".$criteria." ";

        foreach ($metadata['columns'] as $key => $value) {
            $criteria = str_replace(" ".$key." ", " ".$value." ", $criteria);
        }

        return $criteria;
    }

    private function getCriteriaParametersMetadata(string $entity): array
    {
        return arrayFind($this->config, fn ($conf) => (new $conf['model'])->getTable() === $entity);
    }
}