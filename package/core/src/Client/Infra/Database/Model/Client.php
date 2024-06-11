<?php

namespace Epush\Core\Client\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Epush\Auth\User\Infra\Database\Model\User;
use Epush\Core\Sales\Infra\Database\Model\Sales;
use Epush\Core\BusinessField\Infra\Database\Model\BusinessField;

class Client extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'use_api_key' => 'boolean',
        'use_ip_address' => 'boolean',
    ];

    public function websites(): HasMany
    {
        return $this->hasMany(ClientWebsite::class, 'client_id');
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    public function businessField(): BelongsTo
    {
        return $this->belongsTo(BusinessField::class, 'business_field_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
}