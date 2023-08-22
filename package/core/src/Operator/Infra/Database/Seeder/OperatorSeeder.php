<?php

namespace Epush\Core\Operator\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\Operator\Infra\Database\Model\Operator;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        Operator::create([
            'name' => 'Vodafone',
            'code' => '10',
        ]);

        Operator::create([
            'name' => 'Etisalat',
            'code' => '11',
        ]);

        Operator::create([
            'name' => 'Orange',
            'code' => '12',
        ]);

        Operator::create([
            'name' => 'WE',
            'code' => '15',
        ]);
    }
}