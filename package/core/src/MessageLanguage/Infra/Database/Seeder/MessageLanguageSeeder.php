<?php

namespace Epush\Core\MessageLanguage\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\Core\MessageLanguage\Infra\Database\Model\MessageLanguage;
use Illuminate\Database\Seeder;

class MessageLanguageSeeder extends Seeder
{
    public function run(): void
    {
        MessageLanguage::create([
            'name' => 'Arabic',
            'max_characters_length' => '70',
            'split_characters_length' => '67',
        ]);

        MessageLanguage::create([
            'name' => 'English',
            'max_characters_length' => '160',
            'split_characters_length' => '153',
        ]);
    }
}