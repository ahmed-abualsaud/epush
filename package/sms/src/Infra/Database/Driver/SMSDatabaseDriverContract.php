<?php

namespace Epush\SMS\Infra\Database\Driver;

use Epush\SMS\Infra\Database\Repository\Contract\SMSTemplateRepositoryContract;
use Epush\SMS\Infra\Database\Repository\Contract\SMSSendingHandlerRepositoryContract;

interface SMSDatabaseDriverContract
{
    public function smsTemplateRepository(): SMSTemplateRepositoryContract;

    public function smsSendingHandlerRepository(): SMSSendingHandlerRepositoryContract;
}