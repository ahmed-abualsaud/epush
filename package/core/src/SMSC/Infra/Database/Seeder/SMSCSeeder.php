<?php

namespace Epush\Core\SMSC\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\SMSC\Infra\Database\Model\SMSC;
use Illuminate\Database\Seeder;

class SMSCSeeder extends Seeder
{
    public function run(): void
    {
        SMSC::create([
            'name' => 'Cequence Orange',
            'value' => 'ceqmn',
        ]);

        SMSC::create([
            'name' => 'Cequence WE',
            'value' => 'ceqwe',
        ]);

        SMSC::create([
            'name' => 'Cequence Etisalat',
            'value' => 'ceqeti',
        ]);

        SMSC::create([
            'name' => 'Cequence Vodafone',
            'value' => 'ceqvf',
        ]);

        SMSC::create([
            'name' => 'VL Orange',
            'value' => 'vicmn',
        ]);

        SMSC::create([
            'name' => 'VL WE',
            'value' => 'vicwe',
        ]);

        SMSC::create([
            'name' => 'VL Etisalat',
            'value' => 'viceti',
        ]);

        SMSC::create([
            'name' => 'VL Vodafone',
            'value' => 'vicvf',
        ]);

        SMSC::create([
            'name' => 'ARPU Orange',
            'value' => 'arpumn',
        ]);

        SMSC::create([
            'name' => 'ARPU WE',
            'value' => 'arpuwe',
        ]);

        SMSC::create([
            'name' => 'ARPU Etisalat',
            'value' => 'arpueti',
        ]);

        SMSC::create([
            'name' => 'ARPU Vodafone',
            'value' => 'arpuvf',
        ]);

        SMSC::create([
            'name' => 'Victory-TRX Orange',
            'value' => 'vicmntrx',
        ]);

        SMSC::create([
            'name' => 'Victory-TRX WE',
            'value' => 'vicwetrx',
        ]);

        SMSC::create([
            'name' => 'Victory-TRX Etisalat',
            'value' => 'vicetitrx',
        ]);

        SMSC::create([
            'name' => 'Victory-TRX Vodafone',
            'value' => 'vicvftrx',
        ]);

        SMSC::create([
            'name' => 'Cequence Emirates',
            'value' => 'ceqemirates',
        ]);

        SMSC::create([
            'name' => 'Cequence Saudi Arabia',
            'value' => 'ceqsaudi',
        ]);

        SMSC::create([
            'name' => 'Cequence Kuwait',
            'value' => 'ceqkuwait',
        ]);

        SMSC::create([
            'name' => 'Cequence Qatar',
            'value' => 'ceqqatar',
        ]);

        SMSC::create([
            'name' => 'Cequence International',
            'value' => 'ceqint',
        ]);
    }
}