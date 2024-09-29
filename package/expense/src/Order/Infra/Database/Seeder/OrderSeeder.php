<?php

namespace Epush\Expense\Order\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Expense\Order\Infra\Database\Model\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Order::create([
            // 'id' => 1,
            'credit' => config('client.default_balance'),
            'status' => 'Paid',
            'user_id' => 1,
            'pricelist_id' => config('client.default_price_list_id'),
            'payment_method_id' => config('client.default_payment_method_id'),
            'deduct' => 0,
            'collection_date' => date('Y:m:d H:i:s')
        ]);

        Order::create([
            // 'id' => 2,
            'credit' => config('client.default_balance'),
            'status' => 'Paid',
            'user_id' => 2,
            'pricelist_id' => config('client.default_price_list_id'),
            'payment_method_id' => config('client.default_payment_method_id'),
            'deduct' => 0,
            'collection_date' => date('Y:m:d H:i:s')
        ]);
    }
}

