<?php

namespace Epush\Core\BusinessField\App\Service;

use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;
use Epush\Core\BusinessField\App\Contract\BusinessFieldDatabaseServiceContract;

class BusinessFieldService implements BusinessFieldServiceContract
{
    public function __construct(

        private BusinessFieldDatabaseServiceContract $businessFieldDatabaseService

    ) {}

    public function list(): array
    {
        return $this->businessFieldDatabaseService->listBusinessFields();
    }

    public function get(string $businessFieldID): array
    {
        return $this->businessFieldDatabaseService->getBusinessField($businessFieldID);
    }

    public function add(array $businessField): array
    {
        return $this->businessFieldDatabaseService->addBusinessField($businessField);
    }

    public function update(string $businessFieldID, array $data): array
    {
        return $this->businessFieldDatabaseService->updateBusinessField($businessFieldID, $data);
    }

    public function delete(string $businessFieldID): bool
    {
        return $this->businessFieldDatabaseService->deleteBusinessField($businessFieldID);
    }
}