<?php

namespace Epush\Core\MessageLanguage\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageLanguage\Infra\Database\Model\MessageLanguage;
use Epush\Core\MessageLanguage\Infra\Database\Repository\Contract\MessageLanguageRepositoryContract;

class MessageLanguageRepository implements MessageLanguageRepositoryContract
{
    public function __construct(

        private MessageLanguage $messageLanguage
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageLanguage->paginate($take)->toArray();

        });
    }

    public function get(string $messageLanguageID): array
    {
        return DB::transaction(function () use ($messageLanguageID) {

            $messageLanguage =  $this->messageLanguage->where('id', $messageLanguageID)->first();
            return empty($messageLanguage) ? [] : $messageLanguage->toArray();
        });
    }
    
    public function create(array $messageLanguage): array
    {
        return DB::transaction(function () use ($messageLanguage) {

            return $this->messageLanguage->create($messageLanguage)->toArray();
        });
    }

    public function delete(string $messageLanguageID): bool
    {
        return DB::transaction(function () use ($messageLanguageID) {

            return $this->messageLanguage->where('id', $messageLanguageID)->delete();

        }); 
    }

    public function update(string $messageLanguageID, array $data): array
    {
        return DB::transaction(function () use ($messageLanguageID, $data) {

            $messageLanguage = $this->messageLanguage->where('id', $messageLanguageID)->firstOrFail();

            if (! empty($data)) {
                $messageLanguage->update($data);
            }

            return $messageLanguage->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->messageLanguage
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}