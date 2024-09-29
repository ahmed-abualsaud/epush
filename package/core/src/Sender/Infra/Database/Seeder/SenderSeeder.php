<?php

namespace Epush\Core\Sender\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\Sender\App\Service\SenderService;
use Epush\Core\Sender\Infra\Database\Model\Sender;
use Illuminate\Database\Seeder;

class SenderSeeder extends Seeder
{
    public function run(): void
    {
        // app(SenderService::class)->initSystemSender();

        Sender::create([
            // 'id' => 1,
            'user_id' => 1,
            'name' => 'E-Push',
            'approved' => 1
        ]);

        Sender::create([
            // 'id' => 2,
            'user_id' => 2,
            'name' => 'E-Push-Client',
            'approved' => 1
        ]);
    }
}