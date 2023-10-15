<?php

namespace Epush\Notification\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Notification\Infra\Database\Model\NotificationTemplate;
use Illuminate\Database\Seeder;

class NotificationTemplateSeeder extends Seeder
{
    public function run(): void
    {
        NotificationTemplate::create([
            'name' => 'Client Added Notification Template',
            'subject' => 'Welcome to Epush Agency',
            'template' => 
                'Your password is: {{password}}',
        ]);

        NotificationTemplate::create([
            'name' => 'Order Added Notification Template',
            'subject' => 'New Order Added',
            'template' => 
                'Order has been created successfully!',
        ]);
    }
}