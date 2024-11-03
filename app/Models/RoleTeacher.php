<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleTeacher extends Model
{
    //
    public function teacher(): BelongsTo{
        return $this->belongsTo(Teacher::class);
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }
}
