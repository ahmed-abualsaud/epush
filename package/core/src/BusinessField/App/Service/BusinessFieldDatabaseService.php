<?php

namespace Epush\Core\BusinessField\App\Service;

use Epush\Core\BusinessField\App\Contract\BusinessFieldDatabaseServiceContract;
use Epush\Core\BusinessField\Infra\Database\Driver\BusinessFieldDatabaseDriverContract;

class BusinessFieldDatabaseService implements BusinessFieldDatabaseServiceContract
{
    public function __construct(

        private BusinessFieldDatabaseDriverContract $businessFieldDatabaseDriver

    ) {}

    public function listBusinessFields(): array
    {
        return $this->businessFieldDatabaseDriver->businessFieldRepository()->all();
    }

    public function getBusinessField(string $businessFieldID): array
    {
        return $this->businessFieldDatabaseDriver->businessFieldRepository()->get($businessFieldID);
    }

    public function addBusinessField(array $businessField): array
    {
        return $this->businessFieldDatabaseDriver->businessFieldRepository()->create($businessField);
    }

    public function updateBusinessField(string $businessFieldID, array $data): array
    {
        return $this->businessFieldDatabaseDriver->businessFieldRepository()->update($businessFieldID, $data);
    }

    public function deleteBusinessField(string $businessFieldID): bool
    {
        return $this->businessFieldDatabaseDriver->businessFieldRepository()->delete($businessFieldID);
    }
}