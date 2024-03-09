<?php

namespace Epush\Expense\Order\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Expense\Order\Infra\Database\Model\Order;
use Epush\Expense\Order\Infra\Database\Repository\Contract\OrderRepositoryContract;

class OrderRepository implements OrderRepositoryContract
{
    public function __construct(

        private Order $order
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->order->paginate($take)->toArray();

        });
    }

    public function get(string $orderID): array
    {
        return DB::transaction(function () use ($orderID) {

            $order =  $this->order->where('id', $orderID)->first();
            return empty($order) ? [] : $order->toArray();

        });
    }
    
    public function create(array $order): array
    {
        return DB::transaction(function () use ($order) {

            return $this->order->create($order)->toArray();

        });
    }

    public function update(string $orderID, array $data): array
    {
        return DB::transaction(function () use ($orderID, $data) {

            $order = $this->order->where('id', $orderID)->firstOrFail();

            if (! empty($data)) {
                $order->update($data);
            }

            return $order->toArray();

        });
    }

    public function getClientOrders(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->order->where('user_id', $userID)->get()->toArray();

        });
    }
    
    public function getClientLatestOrder(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            $latestOrder =  $this->order->where('user_id', $userID)
            // ->where('status', 'Paid')
            ->latest()->first();
            return empty($latestOrder)? [] : $latestOrder->toArray();
        });
    }

    public function getOrdersByID(array $ordersID, int $take = 10): array
    {
        return DB::transaction(function () use ($ordersID, $take) {

            $orders = $this->order->whereIn('id', $ordersID); 
            $orders = $take >= 1000000000000 ? $orders->paginate($take, ['*'], 'page', 1) : $orders->paginate($take);
            return $orders->toArray();

        });
    }

    public function getOrdersByUsersID(array $usersID, int $take = 10): array
    {
        return DB::transaction(function () use ($usersID, $take) {

            return $this->order->whereIn('user_id', $usersID)->paginate($take)->toArray();

        });
    }

    public function getOrdersByPricelistsID(array $pricelistsID, int $take = 10): array
    {
        return DB::transaction(function () use ($pricelistsID, $take) {

            return $this->order->whereIn('pricelist_id', $pricelistsID)->paginate($take)->toArray();

        });
    }

    public function getOrdersByPaymentMethodsID(array $paymentMethodsID, int $take = 10): array
    {
        return DB::transaction(function () use ($paymentMethodsID, $take) {

            return $this->order->whereIn('payment_method_id', $paymentMethodsID)->paginate($take)->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->order
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();

        });
    }
}