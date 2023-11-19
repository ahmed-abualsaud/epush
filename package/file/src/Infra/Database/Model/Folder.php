<?php

namespace Epush\File\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    protected $guarded = [];

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'folder_id');
    }
}