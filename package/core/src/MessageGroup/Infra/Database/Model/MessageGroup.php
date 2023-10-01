<?php

namespace Epush\Core\MessageGroup\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Epush\Core\MessageGroupRecipient\Infra\Database\Model\MessageGroupRecipient;

class MessageGroup extends Model
{
    protected $guarded = [];

    public function recipients(): HasMany
    {
        return $this->hasMany(MessageGroupRecipient::class, 'message_group_id');
    }
}