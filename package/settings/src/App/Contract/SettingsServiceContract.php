<?php

namespace Epush\Settings\App\Contract;

interface SettingsServiceContract
{
    public function list(int $take): array;

    public function get(string $settingsID): array;

    public function getByName(string $settingsName): array;

    public function add(array $settings): array;

    public function update(string $settingsID, array $settings): array;

    public function delete(string $settingsID): bool;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}