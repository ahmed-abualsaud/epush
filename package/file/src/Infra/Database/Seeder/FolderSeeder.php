<?php

namespace Epush\File\Infra\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Epush\File\Infra\Database\Model\Folder;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    public function run(): void
    {
        Folder::create([
            'name' => 'DLR',
            'description' => 'folder contains all DLR files'
        ]);
    }
}