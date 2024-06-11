<?php

namespace Epush\Core\Partner\App\Service;

use Epush\Core\Partner\App\Contract\PartnerDatabaseServiceContract;
use Epush\Core\Partner\Infra\Database\Driver\PartnerDatabaseDriverContract;

class PartnerDatabaseService implements PartnerDatabaseServiceContract
{
    public function __construct(

        private PartnerDatabaseDriverContract $partnerDatabaseDriver

    ) {}

    public function getPartner(string $userID): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->get($userID);
    }

    public function getPartners(array $usersID): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->getPartners($usersID);
    }

    public function paginatePartners(int $take): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->all($take);
    }

    public function addPartner(array $partner): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->create($partner);
    }

    public function updatePartner(string $userID, array $partner): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->update($userID, $partner);
    }

    public function deletePartner(string $userID): bool
    {
        return $this->partnerDatabaseDriver->partnerRepository()->delete($userID);
    }

    public function searchPartnerColumn(string $column, string $value, int $take = 10): array
    {
        return $this->partnerDatabaseDriver->partnerRepository()->searchColumn($column, $value, $take);
    }
}