<?php

namespace Epush\Core\Message\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Epush\Core\Sender\Infra\Database\Model\Sender;
use Epush\Core\MessageSegment\Infra\Database\Model\MessageSegment;
use Epush\Core\MessageLanguage\Infra\Database\Model\MessageLanguage;
use Epush\Core\MessageRecipient\Infra\Database\Model\MessageRecipient;

class Message extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sent' => 'boolean',
        'draft' => 'boolean',
        'approved' => 'boolean',
    ];

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

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Sender::class, 'sender_id');
    }

    // protected function length(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (mixed $value, array $attributes) => $attributes['length'],
    //         set: fn (mixed $value, array $attributes) => strlen($attributes['content']),
    //     );
    // }

}