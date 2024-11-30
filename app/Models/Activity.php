<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
     protected $guarded = ['id'];

      public function attendances(): HasMany {
        return $this->hasMany(Attendance::class);
    }
}
