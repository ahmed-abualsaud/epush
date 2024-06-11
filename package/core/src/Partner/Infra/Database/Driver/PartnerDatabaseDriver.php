<?php

namespace Epush\Core\Partner\Infra\Database\Driver;

use Epush\Core\Partner\Infra\Database\Repository\Contract\PartnerRepositoryContract;

class PartnerDatabaseDriver implements PartnerDatabaseDriverContract
{
    public function __construct(

        private PartnerRepositoryContract $partnerRepository

    ) {}

    public function partnerRepository(): PartnerRepositoryContract
    {
        return $this->partnerRepository;
    }
}