<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function activity(): BelongsTo{
        return $this->belongsTo(Activity::class);
    }

    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
}
