<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Context extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean',
        'online' => 'boolean'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(AppService::class, 'service_id');
    }

    public function handleGroups(): HasMany
    {
        return $this->hasMany(HandleGroup::class, 'context_id');
    }
}