<?php

namespace Epush\Core\Pricelist\Present\Http\Controller;

use Epush\Core\Pricelist\Domain\DTO\PricelistDto;
use Epush\Core\Pricelist\Domain\DTO\AddPricelistDto;
use Epush\Core\Pricelist\Domain\DTO\UpdatePricelistDto;

use Epush\Core\Pricelist\Domain\UseCase\AddPricelistUseCase;
use Epush\Core\Pricelist\Domain\UseCase\GetPricelistUseCase;
use Epush\Core\Pricelist\Domain\UseCase\ListPricelistsUseCase;
use Epush\Core\Pricelist\Domain\UseCase\DeletePricelistUseCase;
use Epush\Core\Pricelist\Domain\UseCase\UpdatePricelistUseCase;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/pricelist')]
class PricelistController
{
    #[Get('/')]
    public function listPricelists(ListPricelistsUseCase $listPricelistsUseCase): Response
    {
        return successJSONResponse($listPricelistsUseCase->execute());
    }

    #[Post('/')]
    public function addPricelist(AddPricelistDto $addPricelistDto, AddPricelistUseCase $addPricelistUseCase): Response
    {
        return successJSONResponse($addPricelistUseCase->execute($addPricelistDto));
    }

    #[Get('{pricelist_id}')]
    public function getPricelist(PricelistDto $pricelistDto, GetPricelistUseCase $getPricelistUseCase): Response
    {
        return successJSONResponse($getPricelistUseCase->execute($pricelistDto));
    }

    #[Put('{pricelist_id}')]
    public function updatePricelist(PricelistDto $pricelistDto, UpdatePricelistDto $updatePricelistDto, UpdatePricelistUseCase $updatePricelistUseCase): Response
    {
        return successJSONResponse($updatePricelistUseCase->execute($pricelistDto, $updatePricelistDto));
    }

    #[Delete('{pricelist_id}')]
    public function deletePricelist(PricelistDto $pricelistDto, DeletePricelistUseCase $deletePricelistUseCase): Response
    {
        return successJSONResponse($deletePricelistUseCase->execute($pricelistDto));
    }
}