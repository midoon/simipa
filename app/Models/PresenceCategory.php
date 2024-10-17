<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PresenceCategory extends Model
{
    protected $guarded = ['id'];

    public function presences(): HasMany {
        return $this->hasMany(Presence::class);
    }
}
