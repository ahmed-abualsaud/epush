<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Handler extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean',
        'access_user' => 'boolean',
    ];

    public function handleGroup(): BelongsTo
    {
        return $this->belongsTo(HandleGroup::class, 'handle_group_id');
    }
}