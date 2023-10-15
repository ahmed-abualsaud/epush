<?php

namespace Epush\SMS\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SMSTemplateSeeder::class);
        $this->call(SMSSendingHandlerSeeder::class);
    }
}

