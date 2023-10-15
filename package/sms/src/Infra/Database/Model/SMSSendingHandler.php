<?php

namespace Epush\SMS\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SMSSendingHandler extends Model
{
    protected $table = "sms_sending_handlers";

    protected $guarded = [];


    public function smsTemplate(): BelongsTo
    {
        return $this->belongsTo(SMSTemplate::class, 'sms_template_id');
    }
}