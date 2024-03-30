<?php

namespace Epush\Core\Banner\Infra\Database\Driver;

use Epush\Core\Banner\Infra\Database\Repository\Contract\BannerRepositoryContract;

class BannerDatabaseDriver implements BannerDatabaseDriverContract
{
    public function __construct(

        private BannerRepositoryContract $bannerRepository

    ) {}

    public function bannerRepository(): BannerRepositoryContract
    {
        return $this->bannerRepository;
    }
}