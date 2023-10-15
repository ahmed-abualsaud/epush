<?php

namespace Epush\Mail\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailSendingHandler extends Model
{
    protected $table = "mail_sending_handlers";

    protected $guarded = [];


    public function mailTemplate(): BelongsTo
    {
        return $this->belongsTo(MailTemplate::class, 'mail_template_id');
    }
}