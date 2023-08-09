<?php

namespace Epush\Core\Client\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Epush\Core\Sales\Infra\Database\Model\Sales;
use Epush\Core\BusinessField\Infra\Database\Model\BusinessField;

class Client extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];


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
}