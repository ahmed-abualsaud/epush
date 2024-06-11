<?php

namespace Epush\Core\Partner\App\Contract;

interface PartnerDatabaseServiceContract
{
    public function getPartner(string $userID): array;

    public function getPartners(array $usersID): array;

    public function addPartner(array $partner): array;

    public function deletePartner(string $userID): bool;

    public function updatePartner(string $userID, array $partner): array;

    public function paginatePartners(int $take): array;

    public function searchPartnerColumn(string $column, string $value, int $take = 10): array;
}