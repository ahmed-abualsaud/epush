<?php

namespace Epush\Core\SenderConnection\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Core\SMSCBinding\Infra\Database\Model\SMSCBinding;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SenderConnection extends Model
{
    protected $table = 'senders_connections';
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approved' => 'boolean',
        'default' => 'boolean',
        'sender_approved' => 'boolean',
    ];

    public function smsc(): BelongsTo
    {
        return $this->belongsTo(SMSCBinding::class, 'smsc_id');
    }
}