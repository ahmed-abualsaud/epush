<?php

namespace Epush\Core\Banner\App\Service;

use Epush\Core\Banner\App\Contract\BannerServiceContract;
use Epush\Core\Banner\App\Contract\BannerDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class BannerService implements BannerServiceContract
{
    public function __construct(

        private BannerDatabaseServiceContract $bannerDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}

    public function list(): array
    {
        return $this->bannerDatabaseService->listBanners();
    }

    public function get(string $bannerID): array
    {
        return $this->bannerDatabaseService->getBanner($bannerID);
    }

    public function add(array $banner): array
    {
        $banner['image'] = $this->communicationEngine->broadcast('file:store', 'image', 'banners', 'banner-'.time())[0];
        return $this->bannerDatabaseService->addBanner($banner);
    }

    public function update(string $bannerID, array $data): array
    {
        $data['image'] = $this->communicationEngine->broadcast('file:store', 'image', 'banners', 'banner-'.time())[0];
        return $this->bannerDatabaseService->updateBanner($bannerID, $data);
    }

    public function delete(string $bannerID): bool
    {
        $banner = $this->get($bannerID);
        $this->communicationEngine->broadcast('file:delete', basename($banner['image']), 'banners');
        return $this->bannerDatabaseService->deleteBanner($bannerID);
    }

    public function getBanners(array $bannersID): array
    {
        return $this->bannerDatabaseService->getBanners($bannersID);
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return $this->bannerDatabaseService->searchBannerColumn($column, $value, $take);
    }
}