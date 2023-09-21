<?php

namespace Epush\Mail\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Mail\Infra\Database\Model\MailTemplate;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        MailTemplate::create([
            'name' => 'Client Added Mail Template',
            'template' => 
                'You can send your SMS from this credentials: <br /><br />
                <strong>URL:</strong> <a href="https://epushagency.com" style="color: #063F30; cursor: pointer; text-decoration: underline;">epushagency.com</a><br /><br />
                <strong>Username:</strong> {username}<br /><br />
                <strong>Password:</strong> sent by SMS to <strong>{phone}</strong><br /><br />
                For any issues on services please contact us at <a href="mailto:support@epushagency.com" style="color: #063F30!important; cursor: pointer; text-decoration: underline;">support@epushagency.com</a>
                <br /><br />
                For API service please contact your account manger or contact us at <a href="mailto:support@epushagency.com" style="color: #063F30!important; cursor: pointer; text-decoration: underline;">support@epushagency.com</a>
                <br /><br />
                Best Regards <br />
                E-push team',
        ]);

        MailTemplate::create([
            'name' => 'Order Added Mail Template',
            'template' => 
                'Order has been created successfully: <br/><br/>
                <strong>Order Cost:</strong> {credit}<br/><br/>
                <strong>Message Price:</strong> {price}<br/><br/>
                <strong>Your Balance:</strong> {balance}<br/><br/>
                <strong>Number Of Messages:</strong> {messages_count}<br/><br/>
                Best Regards <br/>
                E-push team',
        ]);
    }
}