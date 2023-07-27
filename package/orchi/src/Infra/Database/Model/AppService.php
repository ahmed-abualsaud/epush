<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppService extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean',
        'online' => 'boolean'
    ];

    public function contexts(): HasMany
    {
        return $this->hasMany(Context::class, 'service_id');
    }
}