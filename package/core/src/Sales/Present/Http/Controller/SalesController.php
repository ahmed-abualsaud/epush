<?php

namespace Epush\Core\Sales\Present\Http\Controller;

use Epush\Core\Sales\Domain\DTO\SalesDto;
use Epush\Core\Sales\Domain\DTO\AddSalesDto;
use Epush\Core\Sales\Domain\DTO\UpdateSalesDto;

use Epush\Core\Sales\Domain\UseCase\AddSalesUseCase;
use Epush\Core\Sales\Domain\UseCase\GetSalesUseCase;
use Epush\Core\Sales\Domain\UseCase\ListSalesUseCase;
use Epush\Core\Sales\Domain\UseCase\DeleteSalesUseCase;
use Epush\Core\Sales\Domain\UseCase\UpdateSalesUseCase;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/sales')]
class SalesController
{
    #[Get('/')]
    public function listSales(ListSalesUseCase $listSalesUseCase): Response
    {
        return jsonResponse($listSalesUseCase->execute());
    }

    #[Post('/')]
    public function addSales(AddSalesDto $addSalesDto, AddSalesUseCase $addSalesUseCase): Response
    {
        return jsonResponse($addSalesUseCase->execute($addSalesDto));
    }

    #[Get('{sales_id}')]
    public function getSales(SalesDto $salesDto, GetSalesUseCase $getSalesUseCase): Response
    {
        return jsonResponse($getSalesUseCase->execute($salesDto));
    }

    #[Put('{sales_id}')]
    public function updateSales(SalesDto $salesDto, UpdateSalesDto $updateSalesDto, UpdateSalesUseCase $updateSalesUseCase): Response
    {
        return jsonResponse($updateSalesUseCase->execute($salesDto, $updateSalesDto));
    }

    #[Delete('{sales_id}')]
    public function deleteSales(SalesDto $salesDto, DeleteSalesUseCase $deleteSalesUseCase): Response
    {
        return jsonResponse($deleteSalesUseCase->execute($salesDto));
    }
}