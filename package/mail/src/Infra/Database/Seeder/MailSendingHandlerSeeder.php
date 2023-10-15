<?php

namespace Epush\Mail\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Mail\Infra\Database\Model\MailSendingHandler;
use Illuminate\Database\Seeder;

class MailSendingHandlerSeeder extends Seeder
{
    public function run(): void
    {
        MailSendingHandler::create([
            'name' => 'Client Added Mail',
            'handler_id' => '46',
            'mail_template_id' => '1'
        ]);

        MailSendingHandler::create([
            'name' => 'Order Added Mail',
            'handler_id' => '110',
            'mail_template_id' => '2'
        ]);
    }
}