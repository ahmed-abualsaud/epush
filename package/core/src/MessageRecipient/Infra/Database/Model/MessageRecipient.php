<?php

namespace Epush\Core\MessageRecipient\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Epush\Core\Message\Infra\Database\Model\Message;
use Epush\Core\MessageGroupRecipient\Infra\Database\Model\MessageGroupRecipient;

class MessageRecipient extends Model
{
    protected $guarded = [];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function messageGroupRecipient(): BelongsTo
    {
        return $this->belongsTo(MessageGroupRecipient::class, 'message_group_recipient_id');
    }
}