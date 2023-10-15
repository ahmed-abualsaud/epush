<?php

namespace Epush\Notification\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Notification\Infra\Database\Model\NotificationSendingHandler;
use Illuminate\Database\Seeder;

class NotificationSendingHandlerSeeder extends Seeder
{
    public function run(): void
    {
        NotificationSendingHandler::create([
            'name' => 'Client Added Notification',
            'handler_id' => '46',
            'notification_template_id' => '1'
        ]);

        NotificationSendingHandler::create([
            'name' => 'Order Added Notification',
            'handler_id' => '110',
            'notification_template_id' => '2'
        ]);
    }
}