<?php

namespace Epush\Core\Banner\Infra\Database\Driver;

use Epush\Core\Banner\Infra\Database\Repository\Contract\BannerRepositoryContract;

interface BannerDatabaseDriverContract
{
    public function bannerRepository(): BannerRepositoryContract;
}