<?php

namespace Epush\Core\MessageLanguage\Infra\Database\Repository\Contract;

interface MessageLanguageRepositoryContract
{
    public function all(int $take): array;

    public function get(string $messageLanguageID): array;

    public function getByName(string $messageLanguageName): array;

    public function create(array $messageLanguage): array;

    public function update(string $messageLanguageID, array $messageLanguage): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}