<?php

namespace Epush\Expense\Order\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Expense\Order\Domain\DTO\OrderDto;
use Epush\Expense\Order\Domain\DTO\AddOrderDto;
use Epush\Expense\Order\Domain\DTO\ListOrdersDto;
use Epush\Expense\Order\Domain\DTO\SearchOrderDto;
use Epush\Expense\Order\Domain\DTO\UpdateOrderDto;
use Epush\Expense\Order\Domain\UseCase\GetOrderUseCase;
use Epush\Expense\Order\Domain\UseCase\AddOrderUseCase;
use Epush\Expense\Order\Domain\UseCase\ListOrdersUseCase;
use Epush\Expense\Order\Domain\UseCase\SearchOrderUseCase;
use Epush\Expense\Order\Domain\UseCase\UpdateOrderUseCase;
use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/expense/order')]
class OrderController
{
    #[Get('/')]
    public function listOrders(ListOrdersDto $listOrdersDto, ListOrdersUseCase $listOrdersUseCase): Response
    {
        return jsonResponse($listOrdersUseCase->execute($listOrdersDto));
    }

    #[Post('/')]
    public function addOrder(AddOrderDto $addOrderDto, AddOrderUseCase $addOrderUseCase): Response
    {
        return jsonResponse($addOrderUseCase->execute($addOrderDto));
    }

    #[Get('{order_id}')]
    public function getOrder(OrderDto $orderDto, GetOrderUseCase $getOrderUseCase): Response
    {
        return jsonResponse($getOrderUseCase->execute($orderDto));
    }

    #[Put('{order_id}')]
    public function updateOrder(OrderDto $orderDto, UpdateOrderDto $updateOrderDto, UpdateOrderUseCase $updateOrderUseCase): Response
    {
        return jsonResponse($updateOrderUseCase->execute($orderDto, $updateOrderDto));
    }

    #[Post('/search')]
    public function searchOrderColumn(SearchOrderDto $searchOrderDto, SearchOrderUseCase $searchOrderUseCase): Response
    {
        return jsonResponse($searchOrderUseCase->execute($searchOrderDto));
    }
}