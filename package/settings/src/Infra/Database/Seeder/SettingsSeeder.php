<?php

namespace Epush\Settings\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Settings\Infra\Database\Model\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Settings::create([
            'name' => 'Maximum Number of Messages Segments',
            'type' => 'integer',
            'value' => 8,
            'description' => 'It refers to the limit on the number of separate parts that a message can be divided into for transmission'
        ]);

        Settings::create([
            'name' => 'Message Approvement Limit',
            'type' => 'integer',
            'value' => 100,
            'description' => 'It refers to a configuration that requires administrative approval when the number of messages to be sent exceeds 100 messages'
        ]);

        Settings::create([
            'name' => 'Word Filter Threshold',
            'type' => 'float',
            'value' => 75,
            'description' => 'It is a number that indicates the percentage of similarity of a message word to a censored word'
        ]);

        Settings::create([
            'name' => 'Default Country Code',
            'type' => 'integer',
            'value' => 20,
            'description' => 'The country code will be used if a client trying to send a message to phone numbers that does not have a valid country code prefix'
        ]);
    }
}