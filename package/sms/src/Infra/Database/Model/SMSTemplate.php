<?php

namespace Epush\SMS\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class SMSTemplate extends Model
{
    protected $table = "sms_templates";

    protected $guarded = [];
}