<?php

namespace Epush\Mail\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    protected $table = "mail_templates";

    protected $guarded = [];
}