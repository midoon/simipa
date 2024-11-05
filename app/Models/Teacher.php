<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $guarded = ['id'];

    public function teacherAccount(): BelongsTo {
        return $this->belongsTo(TeacherAccount::class);
    }

    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }
}
