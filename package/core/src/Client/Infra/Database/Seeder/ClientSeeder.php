<?php

namespace Epush\Core\Client\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\Client\Infra\Database\Model\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Client::create([
            // 'id' => 1,
            'user_id' => 1,
            'sales_id' => config('client.default_sales_id'),
            'business_field_id' => config('client.default_business_field_id'),
            'company_name' => config('client.default_company_name'),
            'api_key' => config('client.default_api_key'),
            'use_api_key' => true,
            'balance' => config('client.default_balance'),
            'religion' => 'Muslim'
        ]);

        Client::create([
            // 'id' => 2,
            'user_id' => 2,
            'sales_id' => config('client.default_sales_id'),
            'business_field_id' => config('client.default_business_field_id'),
            'company_name' => config('client.default_company_name'),
            'api_key' => config('client.default_api_key'),
            'use_api_key' => true,
            'balance' => config('client.default_balance'),
            'religion' => 'Muslim'
        ]);
    }
}

