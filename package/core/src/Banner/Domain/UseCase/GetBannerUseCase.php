<?php

namespace Epush\Core\Banner\Domain\UseCase;

use Epush\Core\Banner\Domain\DTO\BannerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Banner\App\Contract\BannerServiceContract;

class GetBannerUseCase
{
    public function __construct(

        private BannerServiceContract $bannerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BannerDto $bannerDto): array
    {
        $this->validationService->validate($bannerDto->toArray(), BannerDto::rules());
        return $this->bannerService->get($bannerDto->getBannerID());
    }
}