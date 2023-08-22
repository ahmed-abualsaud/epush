<?php

namespace Epush\Core\SMSCBinding\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Core\SMSC\Infra\Database\Model\SMSC;
use Epush\Core\Country\Infra\Database\Model\Country;
use Epush\Core\Operator\Infra\Database\Model\Operator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SMSCBinding extends Model
{
    protected $table = 'smsc_bindings';

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'default' => 'boolean',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function smsc(): BelongsTo
    {
        return $this->belongsTo(SMSC::class, 'smsc_id');
    }
}