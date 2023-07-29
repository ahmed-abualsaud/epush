<?php

namespace Epush\Core\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];


    public function websites(): HasMany
    {
        return $this->hasMany(ClientWebsite::class, 'client_id');
    }
}