<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $guarded = ['id'];


    public function grade(): BelongsTo{
        return $this->belongsTo(Grade::class);
    }

    public function schedules(): HasMany{
        return $this->hasMany(Schedule::class);
    }

    public function students(): HasMany{
        return $this->hasMany(Student::class);
    }

    public function attendance(): HasMany{
        return $this->hasMany(Attendance::class);
    }
}
