<?php

namespace Epush\SMS\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\SMS\Infra\Database\Model\SMSTemplate;
use Illuminate\Database\Seeder;

class SMSTemplateSeeder extends Seeder
{
    public function run(): void
    {
        SMSTemplate::create([
            'name' => 'Client Added SMS Template',
            'subject' => 'Welcome to Epush Agency',
            'template' => 
                'Your password is: {{password}}',
        ]);

        SMSTemplate::create([
            'name' => 'Order Added SMS Template',
            'subject' => 'New Order Added',
            'template' => 
                'Order has been created successfully!',
        ]);
    }
}