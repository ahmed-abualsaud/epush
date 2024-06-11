<?php

namespace Epush\Core\Partner\Infra\Database\Driver;

use Epush\Core\Partner\Infra\Database\Repository\Contract\PartnerRepositoryContract;

interface PartnerDatabaseDriverContract
{
    public function partnerRepository(): PartnerRepositoryContract;
}