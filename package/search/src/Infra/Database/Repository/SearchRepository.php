<?php

namespace Epush\Search\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Search\Infra\Database\Repository\Contract\SearchRepositoryContract;

class SearchRepository implements SearchRepositoryContract
{
    public function search(string $criteria, string $model, array $selectAs = null, array $joins = null, array $withs = null, int $perPage = 10, int $currentPage = 1): array
    {
        return DB::transaction(function () use ($criteria, $model, $selectAs, $joins, $withs, $perPage, $currentPage) {
            $columns = ['*'];

            if (!empty($selectAs)) {
                $columns = array_merge($columns, $selectAs);
            }

            $model = $model::select($columns);
            
            if (! empty($withs)) {
                $model = $model->with($withs);
            }
            
            if (! empty($joins)) {
                foreach ($joins as $join) {
                    $model = $this->addMysqlJoin($join['type'] ?? 'inner', $join['operator'], $join['source'], $join['destination'], $model);
                }
            }

            if (! empty($criteria)) {
                $model = $model->whereRaw($criteria);
            }

            if (! empty($perPage) && $perPage > 0) {
                return $model->paginate($perPage, ['*'], 'page', $currentPage)->toArray();
            }

            return $model->get()->toArray();

        });
    }

    private function addMysqlJoin(string $type, string $operator, string $source, string $destination, &$model): mixed
    {
        return match (strtolower($type)) {
            "left", "left_join", "left join", "leftjoin" => $model->leftJoin(explode('.', $destination)[0], $source, $operator, $destination),
            "right", "right_join", "right join", "rightjoin" => $model->rightJoin(explode('.', $destination)[0], $source, $operator, $destination),
            "inner", "inner_join", "inner join", "innerjoin" => $model->join(explode('.', $destination)[0], $source, $operator, $destination),
            "cross", "cross_join", "cross join", "crossjoin" => $model->crossJoin(explode('.', $destination)[0], $source, $operator, $destination),
            default => "INNER"
        };
    }
}