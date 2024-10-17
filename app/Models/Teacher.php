<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $guarded = ['id'];

    public function roleTeachers(): HasMany{
        return $this->hasMany(RoleTeacher::class);
    }

    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }
}
