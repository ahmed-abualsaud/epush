<?php

namespace Epush\Core\BusinessField\App\Contract;

interface BusinessFieldServiceContract
{
    public function list(): array;

    public function get(string $businessFieldID): array;

    public function add(array $businessField): array;

    public function update(string $businessFieldID, array $data): array;

    public function delete(string $businessFieldID): bool;
}