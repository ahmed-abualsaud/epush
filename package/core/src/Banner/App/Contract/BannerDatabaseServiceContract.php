<?php

namespace Epush\Core\Banner\App\Contract;

interface BannerDatabaseServiceContract
{
    public function listBanners(): array;

    public function getBanner(string $bannerID): array;

    public function addBanner(array $banner): array;

    public function updateBanner(string $bannerID, array $data): array;

    public function deleteBanner(string $bannerID): bool;

    public function getBanners(array $bannersID): array;

    public function searchBannerColumn(string $column, string $value, int $take = 10): array;
}