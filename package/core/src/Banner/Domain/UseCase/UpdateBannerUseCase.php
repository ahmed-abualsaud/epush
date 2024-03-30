<?php

namespace Epush\Core\Banner\Domain\UseCase;

use Epush\Core\Banner\Domain\DTO\BannerDto;
use Epush\Core\Banner\Domain\DTO\UpdateBannerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Banner\App\Contract\BannerServiceContract;

class UpdateBannerUseCase
{
    public function __construct(

        private BannerServiceContract $bannerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(BannerDto $bannerDto, UpdateBannerDto $updateBannerDto): array
    {
        $this->validationService->validate($bannerDto->toArray(), BannerDto::rules());
        $this->validationService->validate($updateBannerDto->toArray(), UpdateBannerDto::rules());
        return $this->bannerService->update($bannerDto->getBannerID(), $updateBannerDto->toArray());
    }
}