<?php

namespace Epush\Core\MessageFilter\Infra\Database\Driver;

use Epush\Core\MessageFilter\Infra\Database\Repository\Contract\MessageFilterRepositoryContract;

class MessageFilterDatabaseDriver implements MessageFilterDatabaseDriverContract
{
    public function __construct(

        private MessageFilterRepositoryContract $messageFilterRepository

    ) {}

    public function messageFilterRepository(): MessageFilterRepositoryContract
    {
        return $this->messageFilterRepository;
    }
}