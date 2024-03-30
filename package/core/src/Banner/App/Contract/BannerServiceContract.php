<?php

namespace Epush\Core\Banner\App\Contract;

interface BannerServiceContract
{
    public function list(): array;

    public function get(string $bannerID): array;

    public function add(array $banner): array;

    public function update(string $bannerID, array $data): array;

    public function delete(string $bannerID): bool;

    public function getBanners(array $bannersID): array;

    public function searchColumn(string $column, string $value, int $take = 10): array;
}