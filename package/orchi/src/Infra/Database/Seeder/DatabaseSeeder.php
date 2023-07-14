<?php

namespace Epush\Orchi\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AppServiceSeeder::class);
        $this->call(ContextSeeder::class);
        $this->call(HandleGroupSeeder::class);
        $this->call(HandlerSeeder::class);
    }
}

