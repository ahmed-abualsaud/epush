<?php

namespace Epush\SMS\Infra\Database\Driver;

use Epush\SMS\Infra\Database\Repository\Contract\SMSTemplateRepositoryContract;
use Epush\SMS\Infra\Database\Repository\Contract\SMSSendingHandlerRepositoryContract;

class SMSDatabaseDriver implements SMSDatabaseDriverContract
{
    public function __construct(

        private SMSTemplateRepositoryContract $smsTemplateRepository,
        private SMSSendingHandlerRepositoryContract $smsSendingHandlerRepository

    ) {}

    public function smsTemplateRepository(): SMSTemplateRepositoryContract
    {
        return $this->smsTemplateRepository;
    }

    public function SMSSendingHandlerRepository(): SMSSendingHandlerRepositoryContract
    {
        return $this->smsSendingHandlerRepository;
    }
}