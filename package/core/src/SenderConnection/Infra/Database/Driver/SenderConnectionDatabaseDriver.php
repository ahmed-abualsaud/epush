<?php

namespace Epush\Core\SenderConnection\Infra\Database\Driver;

use Epush\Core\SenderConnection\Infra\Database\Repository\Contract\SenderConnectionRepositoryContract;

class SenderConnectionDatabaseDriver implements SenderConnectionDatabaseDriverContract
{
    public function __construct(

        private SenderConnectionRepositoryContract $senderConnectionRepository

    ) {}

    public function SenderConnectionRepository(): SenderConnectionRepositoryContract
    {
        return $this->senderConnectionRepository;
    }
}