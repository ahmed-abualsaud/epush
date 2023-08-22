<?php

namespace Epush\Expense\Order\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Expense\Order\Domain\DTO\OrderDto;
use Epush\Expense\Order\Domain\DTO\AddOrderDto;
use Epush\Expense\Order\Domain\DTO\ListOrdersDto;
use Epush\Expense\Order\Domain\DTO\SearchOrderDto;

use Epush\Expense\Order\Domain\UseCase\GetOrderUseCase;
use Epush\Expense\Order\Domain\UseCase\AddOrderUseCase;
use Epush\Expense\Order\Domain\UseCase\ListOrdersUseCase;
use Epush\Expense\Order\Domain\UseCase\SearchOrderUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/expense/order')]
class OrderController
{
    #[Get('/')]
    public function listOrders(ListOrdersDto $listOrdersDto, ListOrdersUseCase $listOrdersUseCase): Response
    {
        return successJSONResponse($listOrdersUseCase->execute($listOrdersDto));
    }

    #[Post('/')]
    public function addOrder(AddOrderDto $addOrderDto, AddOrderUseCase $addOrderUseCase): Response
    {
        return successJSONResponse($addOrderUseCase->execute($addOrderDto));
    }

    #[Get('{order_id}')]
    public function getOrder(OrderDto $orderDto, GetOrderUseCase $getOrderUseCase): Response
    {
        return successJSONResponse($getOrderUseCase->execute($orderDto));
    }

    #[Post('/search')]
    public function searchOrderColumn(SearchOrderDto $searchOrderDto, SearchOrderUseCase $searchOrderUseCase): Response
    {
        return successJSONResponse($searchOrderUseCase->execute($searchOrderDto));
    }
}