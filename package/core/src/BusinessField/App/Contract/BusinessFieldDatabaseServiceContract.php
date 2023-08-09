<?php

namespace Epush\Core\BusinessField\App\Contract;

interface BusinessFieldDatabaseServiceContract
{
    public function listBusinessFields(): array;

    public function getBusinessField(string $businessFieldID): array;

    public function addBusinessField(array $businessField): array;

    public function updateBusinessField(string $businessFieldID, array $data): array;

    public function deleteBusinessField(string $businessFieldID): bool;
}