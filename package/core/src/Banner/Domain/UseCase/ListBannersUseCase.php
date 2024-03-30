<?php

namespace Epush\Core\Banner\Domain\UseCase;

use Epush\Core\Banner\App\Contract\BannerServiceContract;

class ListBannersUseCase
{
    public function __construct(

        private BannerServiceContract $bannerService

    ) {}

    public function execute(): array
    {
        return $this->bannerService->list();
    }
}