<?php

namespace Epush\Core\SMSC\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class SMSC extends Model
{
    protected $table = 'smscs';

    protected $guarded = [];
}