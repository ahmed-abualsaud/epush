<?php

namespace Epush\Mail\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class MailSendingHandler extends Model
{
    protected $table = "mail_sending_handlers";

    protected $guarded = [];
}