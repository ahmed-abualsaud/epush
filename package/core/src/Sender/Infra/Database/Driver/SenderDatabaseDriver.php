<?php

namespace Epush\Core\Sender\Infra\Database\Driver;

use Epush\Core\Sender\Infra\Database\Repository\Contract\SenderRepositoryContract;

class SenderDatabaseDriver implements SenderDatabaseDriverContract
{
    public function __construct(

        private SenderRepositoryContract $senderRepository

    ) {}

    public function SenderRepository(): SenderRepositoryContract
    {
        return $this->senderRepository;
    }
}