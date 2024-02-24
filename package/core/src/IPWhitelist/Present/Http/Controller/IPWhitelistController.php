<?php

namespace Epush\Core\IPWhitelist\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\IPWhitelist\Domain\DTO\IPWhitelistDto;
use Epush\Core\IPWhitelist\Domain\DTO\AddIPWhitelistDto;
use Epush\Core\IPWhitelist\Domain\DTO\ListIPWhitelistsDto;
use Epush\Core\IPWhitelist\Domain\DTO\UpdateIPWhitelistDto;

use Epush\Core\IPWhitelist\Domain\UseCase\GetIPWhitelistUseCase;
use Epush\Core\IPWhitelist\Domain\UseCase\AddIPWhitelistUseCase;
use Epush\Core\IPWhitelist\Domain\UseCase\ListIPWhitelistsUseCase;
use Epush\Core\IPWhitelist\Domain\UseCase\DeleteIPWhitelistUseCase;
use Epush\Core\IPWhitelist\Domain\UseCase\UpdateIPWhitelistUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/ipwhitelist')]
class IPWhitelistController
{
    #[Get('/')]
    public function listIPWhitelists(ListIPWhitelistsDto $listIPWhitelistsDto, ListIPWhitelistsUseCase $listIPWhitelistsUseCase): Response
    {
        return jsonResponse($listIPWhitelistsUseCase->execute($listIPWhitelistsDto));
    }

    #[Post('/')]
    public function addIPWhitelist(AddIPWhitelistDto $addIPWhitelistDto, AddIPWhitelistUseCase $addIPWhitelistUseCase): Response
    {
        return jsonResponse($addIPWhitelistUseCase->execute($addIPWhitelistDto));
    }

    #[Get('{ipwhitelist_id}')]
    public function getIPWhitelist(IPWhitelistDto $ipwhitelistDto, GetIPWhitelistUseCase $getIPWhitelistUseCase): Response
    {
        return jsonResponse($getIPWhitelistUseCase->execute($ipwhitelistDto));
    }

    #[Put('{ipwhitelist_id}')]
    public function updateIPWhitelist(IPWhitelistDto $ipwhitelistDto, UpdateIPWhitelistDto $updateIPWhitelistDto, UpdateIPWhitelistUseCase $updateIPWhitelistUseCase): Response
    {
        return jsonResponse($updateIPWhitelistUseCase->execute($ipwhitelistDto, $updateIPWhitelistDto));
    }

    #[Delete('{ipwhitelist_id}')]
    public function deleteIPWhitelist(IPWhitelistDto $ipwhitelistDto, DeleteIPWhitelistUseCase $deleteIPWhitelistUseCase): Response
    {
        return jsonResponse($deleteIPWhitelistUseCase->execute($ipwhitelistDto));
    }
}