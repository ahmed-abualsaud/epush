<?php

namespace Epush\Notification\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(NotificationTemplateSeeder::class);
        $this->call(NotificationSendingHandlerSeeder::class);
    }
}

