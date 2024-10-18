<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presence extends Model
{
    protected $guarded = ['id'];

    public function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function presenceCategory(): BelongsTo{
        return $this->belongsTo(PresenceCategory::class);
    }

    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
}
