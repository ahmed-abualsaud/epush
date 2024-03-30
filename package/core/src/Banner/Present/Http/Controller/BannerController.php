<?php

namespace Epush\Core\Banner\Present\Http\Controller;

use Epush\Core\Banner\Domain\DTO\BannerDto;
use Epush\Core\Banner\Domain\DTO\AddBannerDto;
use Epush\Core\Banner\Domain\DTO\UpdateBannerDto;

use Epush\Core\Banner\Domain\UseCase\AddBannerUseCase;
use Epush\Core\Banner\Domain\UseCase\GetBannerUseCase;
use Epush\Core\Banner\Domain\UseCase\ListBannersUseCase;
use Epush\Core\Banner\Domain\UseCase\DeleteBannerUseCase;
use Epush\Core\Banner\Domain\UseCase\UpdateBannerUseCase;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/banner')]
class BannerController
{
    #[Get('/')]
    public function listBanners(ListBannersUseCase $listBannersUseCase): Response
    {
        return jsonResponse($listBannersUseCase->execute());
    }

    #[Post('/')]
    public function addBanner(AddBannerDto $addBannerDto, AddBannerUseCase $addBannerUseCase): Response
    {
        return jsonResponse($addBannerUseCase->execute($addBannerDto));
    }

    #[Get('{banner_id}')]
    public function getBanner(BannerDto $bannerDto, GetBannerUseCase $getBannerUseCase): Response
    {
        return jsonResponse($getBannerUseCase->execute($bannerDto));
    }

    #[Put('{banner_id}')]
    public function updateBanner(BannerDto $bannerDto, UpdateBannerDto $updateBannerDto, UpdateBannerUseCase $updateBannerUseCase): Response
    {
        return jsonResponse($updateBannerUseCase->execute($bannerDto, $updateBannerDto));
    }

    #[Delete('{banner_id}')]
    public function deleteBanner(BannerDto $bannerDto, DeleteBannerUseCase $deleteBannerUseCase): Response
    {
        return jsonResponse($deleteBannerUseCase->execute($bannerDto));
    }
}