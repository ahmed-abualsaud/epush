<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HandleGroup extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    public function context(): BelongsTo
    {
        return $this->belongsTo(Context::class, 'context_id');
    }

    public function handlers(): HasMany
    {
        return $this->hasMany(Handler::class, 'handle_group_id');
    }
}