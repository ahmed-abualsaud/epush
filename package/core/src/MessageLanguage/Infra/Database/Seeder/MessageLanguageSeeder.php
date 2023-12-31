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
            'characters' => 'ضصثقفغعهخحجدشسيبلاتنمكطئءؤرﻻىةوزظذ؟.,آﻵ{}ْ~":/،ـأﻷ[]ٍِ><؛×÷`إﻹًٌَُّ\…1234567890-=+_()*&^%$#@! qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM[];\',./{}:"<>?\|`1234567890-=~!@#$%^&*()_+°©®™€£¥§¶'
        ]);

        MessageLanguage::create([
            'name' => 'English',
            'max_characters_length' => '160',
            'split_characters_length' => '153',
            'characters' => 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM[];\',./{}:"<>?\|`1234567890-=~!@#$%^&*()_+°©®™€£¥§¶'
        ]);

        MessageLanguage::create([
            'name' => 'French',
            'max_characters_length' => '100',
            'split_characters_length' => '95',
            'characters' => 'aeiouyàâæäçéèêëîïôœöùûüÿbcdfghjklmnpqrstvwxyzçæœAEIOUYÀÂÆÄÇÉÈÊËÎÏÔŒÖÙÛÜŸBCDFGHJKLMNPQRSTVWXYZÇÆŒ1234567890.,;:!?\'"()[]{}-_/\|@#$%^&*+=<>~¨´°©®™€£¥§¶`'
        ]);
    }
}