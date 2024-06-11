<?php

namespace Epush\Core\Partner\App\Contract;

interface PartnerServiceContract
{
    public function list(int $take): array;

    public function get(string $userID): array;

    public function add(array $partner, array $user): array;

    public function update(string $userID, array $partner, array $user): array;

    public function delete(string $userID): bool;

    public function searchColumn(string $column, string $value, bool $searchPartner = true, int $take = 10): array;
}