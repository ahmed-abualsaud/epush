<?php

namespace Epush\Core\Message\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Epush\Core\MessageSegment\Infra\Database\Model\MessageSegment;
use Epush\Core\MessageLanguage\Infra\Database\Model\MessageLanguage;
use Epush\Core\MessageRecipient\Infra\Database\Model\MessageRecipient;

class Message extends Model
{
    protected $guarded = [];

    public function language(): BelongsTo
    {
        return $this->belongsTo(MessageLanguage::class, 'message_language_id');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(MessageRecipient::class, 'message_id');
    }

    public function segments(): HasMany
    {
        return $this->hasMany(MessageSegment::class, 'message_id');
    }
}