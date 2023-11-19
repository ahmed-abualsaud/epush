<?php

namespace Epush\File\Infra\Database\Driver\File;

use Epush\File\Infra\Database\Repository\Contract\FileRepositoryContract;

interface FileDatabaseDriverContract
{
    public function fileRepository(): FileRepositoryContract;
}