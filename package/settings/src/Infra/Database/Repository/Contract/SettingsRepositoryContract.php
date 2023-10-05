<?php

namespace Epush\Settings\Infra\Database\Repository\Contract;

interface SettingsRepositoryContract
{
    public function all(int $take): array;

    public function get(string $settingsID): array;

    public function getByName(string $settingsName): array;

    public function create(array $settings): array;

    public function update(string $settingsID, array $settings): array;

    public function delete(string $id): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}