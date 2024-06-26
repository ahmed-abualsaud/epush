<?php

namespace Epush\Core\Partner\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];
}