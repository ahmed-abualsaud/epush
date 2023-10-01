<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Epush\Core\MessageGroup\Infra\Database\Model\MessageGroup;


class MessageGroupRecipient extends Model
{
    protected $guarded = [];

    public function messageGroup(): BelongsTo
    {
        return $this->belongsTo(MessageGroup::class, 'message_group_id');
    }
}