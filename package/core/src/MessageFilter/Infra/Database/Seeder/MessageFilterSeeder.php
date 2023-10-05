<?php

namespace Epush\Core\MessageFilter\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\MessageFilter\Infra\Database\Model\MessageFilter;
use Illuminate\Database\Seeder;

class MessageFilterSeeder extends Seeder
{
    public function run(): void
    {
        MessageFilter::create([
            'name' => 'Vodafone',
        ]);

        MessageFilter::create([
            'name' => 'Etisalat',
        ]);

        MessageFilter::create([
            'name' => 'Orange',
        ]);

        MessageFilter::create([
            'name' => 'WE',
        ]);
    }
}