<?php

namespace Epush\Core\MessageLanguage\App\Contract;

interface MessageLanguageServiceContract
{
    public function list(int $take): array;

    public function get(string $messageLanguageID): array;

    public function getByName(string $messageLanguageName): array;

    public function add(array $messageLanguage): array;

    public function update(string $messageLanguageID, array $messageLanguage): array;

    public function delete(string $messageLanguageID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}