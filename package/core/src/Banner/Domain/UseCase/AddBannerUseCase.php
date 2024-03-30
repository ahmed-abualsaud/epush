<?php

namespace Epush\Core\Banner\Domain\UseCase;

use Epush\Core\Banner\Domain\DTO\AddBannerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\Banner\App\Contract\BannerServiceContract;

class AddBannerUseCase
{
    public function __construct(

        private BannerServiceContract $bannerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddBannerDto $addBannerDto): array
    {
        $this->validationService->validate($addBannerDto->toArray(), AddBannerDto::rules());
        return $this->bannerService->add($addBannerDto->toArray());
    }
}