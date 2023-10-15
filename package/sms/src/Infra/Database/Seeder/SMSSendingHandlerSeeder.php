<?php

namespace Epush\SMS\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\SMS\Infra\Database\Model\SMSSendingHandler;
use Illuminate\Database\Seeder;

class SMSSendingHandlerSeeder extends Seeder
{
    public function run(): void
    {
        SMSSendingHandler::create([
            'name' => 'Client Added SMS',
            'handler_id' => '46',
            'sms_template_id' => '1'
        ]);

        SMSSendingHandler::create([
            'name' => 'Order Added SMS',
            'handler_id' => '110',
            'sms_template_id' => '2'
        ]);
    }
}