<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleTeacher extends Model
{
    protected $guarded = ['id'];

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class);
    }
}
