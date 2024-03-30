<?php

namespace Epush\Core\Banner\App\Service;

use Epush\Core\Banner\App\Contract\BannerDatabaseServiceContract;
use Epush\Core\Banner\Infra\Database\Driver\BannerDatabaseDriverContract;

class BannerDatabaseService implements BannerDatabaseServiceContract
{
    public function __construct(

        private BannerDatabaseDriverContract $bannerDatabaseDriver

    ) {}

    public function listBanners(): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->all();
    }

    public function getBanner(string $bannerID): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->get($bannerID);
    }

    public function addBanner(array $banner): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->create($banner);
    }

    public function updateBanner(string $bannerID, array $data): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->update($bannerID, $data);
    }

    public function deleteBanner(string $bannerID): bool
    {
        return $this->bannerDatabaseDriver->bannerRepository()->delete($bannerID);
    }

    public function getBanners(array $bannersID): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->getBanners($bannersID);
    }

    public function searchBannerColumn(string $column, string $value, int $take = 10): array
    {
        return $this->bannerDatabaseDriver->bannerRepository()->searchColumn($column, $value, $take);
    }
}